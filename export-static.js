const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

const BASE = 'http://localhost:8881';
const OUT = path.join(__dirname, 'static-export');

const pages = [
  { url: '/', file: 'index.html' },
  { url: '/about/', file: 'about/index.html' },
  { url: '/category/sports/', file: 'category/sports/index.html' },
  { url: '/category/academy/', file: 'category/academy/index.html' },
  { url: '/category/news/', file: 'category/news/index.html' },
  { url: '/category/promotions/', file: 'category/promotions/index.html' },
];

// Clean output
if (fs.existsSync(OUT)) fs.rmSync(OUT, { recursive: true });
fs.mkdirSync(OUT, { recursive: true });

for (const page of pages) {
  const outFile = path.join(OUT, page.file);
  fs.mkdirSync(path.dirname(outFile), { recursive: true });
  console.log(`Downloading ${page.url}`);
  try {
    let html = execSync(`curl -s "${BASE}${page.url}"`, { encoding: 'utf8' });

    // Remove the entire admin bar block (everything from wpadminbar div to before <header)
    html = html.replace(/<div id="wpadminbar"[\s\S]*?(?=<header)/g, '');

    // Remove the customize-support script block
    html = html.replace(/<script>\s*\(function\(\)\s*\{\s*var request[\s\S]*?\/\/#\s*sourceURL=wp_customize_support_script\s*<\/script>/g, '');

    // Clean body classes - remove WP admin/logged-in classes
    html = html.replace(/(class="[^"]*)\blogged-in\b/g, '$1');
    html = html.replace(/(class="[^"]*)\badmin-bar\b/g, '$1');
    html = html.replace(/(class="[^"]*)\bno-customize-support\b/g, '$1');
    html = html.replace(/(class="[^"]*)\bwp-singular\b/g, '$1');
    html = html.replace(/(class="[^"]*)\bcustomize-support\b/g, '$1');

    // Remove WordPress admin bar CSS/links
    html = html.replace(/<link[^>]*admin-bar[^>]*>/g, '');
    html = html.replace(/<link[^>]*dashicons[^>]*>/g, '');
    html = html.replace(/<style id='admin-bar-inline-css'>[\s\S]*?<\/style>/g, '');
    html = html.replace(/html \{ margin-top: 32px !important; \}/g, '');
    html = html.replace(/html \{ margin-top: 46px !important; \}/g, '');

    // Remove wp-includes CSS/JS references
    html = html.replace(/<link[^>]*wp-includes[^>]*>/g, '');
    html = html.replace(/<script[^>]*wp-includes[^>]*>[\s\S]*?<\/script>/g, '');
    html = html.replace(/<script[^>]*wp-emoji[^>]*>[\s\S]*?<\/script>/g, '');

    // Remove ALL WP inline styles
    html = html.replace(/<style id='wp-[^']*'>[\s\S]*?<\/style>/g, '');
    html = html.replace(/<style id='classic-theme-styles-inline-css'>[\s\S]*?<\/style>/g, '');
    html = html.replace(/<style id='global-styles-inline-css'>[\s\S]*?<\/style>/g, '');

    // Remove WP meta/link tags (but NOT the theme stylesheet - that gets rewritten below)
    html = html.replace(/<meta[^>]*generator[^>]*>/g, '');
    html = html.replace(/<meta[^>]*robots[^>]*>/g, '');
    html = html.replace(/<link[^>]*rel="alternate"[^>]*>/g, '');
    html = html.replace(/<link[^>]*dns-prefetch[^>]*>/g, '');
    html = html.replace(/<link[^>]*rel="canonical"[^>]*>/g, '');
    html = html.replace(/<link[^>]*wp-json[^>]*>/g, '');
    html = html.replace(/<link[^>]*xmlrpc[^>]*>/g, '');
    html = html.replace(/<link[^>]*shortlink[^>]*>/g, '');
    html = html.replace(/<link[^>]*rel='https:\/\/api\.w[^>]*>/g, '');

    // Remove Google Fonts link (theme uses its own font import in CSS)
    html = html.replace(/<link[^>]*fonts\.googleapis\.com[^>]*>/g, '');

    // Remove WP footer/inline scripts
    html = html.replace(/<script[^>]*id='wp-[^']*'[^>]*>[\s\S]*?<\/script>/g, '');
    html = html.replace(/<script id='wp-[^']*'>[\s\S]*?<\/script>/g, '');

    // Remove WP emoji module script block
    html = html.replace(/<script type="module">\s*\/\*! This file is auto-generated \*\/[\s\S]*?<\/script>/g, '');

    // Calculate depth for relative paths
    const depth = page.file.split('/').length - 1;
    const prefix = depth > 0 ? '../'.repeat(depth) : './';

    // Rewrite theme asset URLs FIRST (before removing remaining localhost refs)
    // assets/ subfolder maps directly to static-export/assets/
    html = html.replace(/http:\/\/localhost:8881\/wp-content\/themes\/sportnza-theme\/assets\//g, prefix + 'assets/');
    // remaining theme root files (style.css etc) go into assets/ folder
    html = html.replace(/http:\/\/localhost:8881\/wp-content\/themes\/sportnza-theme\//g, prefix + 'assets/');

    // Rewrite internal navigation links
    html = html.replace(/http:\/\/localhost:8881\/category\//g, prefix + 'category/');
    html = html.replace(/http:\/\/localhost:8881\/about\//g, prefix + 'about/');
    html = html.replace(/http:\/\/localhost:8881\/(["'])/g, prefix.replace(/\/$/, '') + '/$1');
    html = html.replace(/http:\/\/localhost:8881/g, '');

    // Rewrite sportnzaData themeUri to relative path
    html = html.replace(/var sportnzaData = \{[^}]*\};/g,
      'var sportnzaData = {"themeUri":"' + prefix.replace(/\/$/, '') + '","ajaxUrl":"","nonce":""};');

    // Rewrite internal post links (single posts aren't exported) to #
    html = html.replace(/href="\/(?!category\/|about\/|blog\/|wp-)[a-z0-9][a-z0-9\-]*\/"/g, 'href="#"');

    // NOW remove any remaining localhost link/meta tags (after URL rewriting saved the ones we need)
    html = html.replace(/<link[^>]*localhost[^>]*>/g, '');

    // Remove empty lines left behind
    html = html.replace(/\n\s*\n\s*\n/g, '\n\n');

    fs.writeFileSync(outFile, html);
  } catch (e) {
    console.error(`Failed: ${page.url}`, e.message);
  }
}

// Copy theme assets
const themeDir = path.join(__dirname, 'sportnza-theme');
const assetsOut = path.join(OUT, 'assets');

function copyDir(src, dest) {
  fs.mkdirSync(dest, { recursive: true });
  for (const entry of fs.readdirSync(src, { withFileTypes: true })) {
    const srcPath = path.join(src, entry.name);
    const destPath = path.join(dest, entry.name);
    if (entry.isDirectory()) {
      copyDir(srcPath, destPath);
    } else {
      fs.copyFileSync(srcPath, destPath);
    }
  }
}

fs.mkdirSync(assetsOut, { recursive: true });
fs.copyFileSync(path.join(themeDir, 'style.css'), path.join(assetsOut, 'style.css'));
if (fs.existsSync(path.join(themeDir, 'assets'))) {
  copyDir(path.join(themeDir, 'assets'), assetsOut);
}

console.log('\nStatic export complete!', OUT);
