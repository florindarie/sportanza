# Sportnza Project Context

## What This Is
A WordPress theme (`sportnza-theme/`) for a sports betting content site. It runs locally via **wp-now** and is statically exported to **GitHub Pages**.

## Critical: Do NOT Re-initialize
- WordPress is **already installed and configured** via wp-now
- The theme is **already active** at `sportnza-theme/`
- **Do NOT** run `wp-now` setup, create a new theme, or scaffold anything — everything exists
- Just start `wp-now` with: `npx wp-now start --path=sportnza-theme`

## Local Development
- **Server**: `npx wp-now start --path=sportnza-theme` → runs at `http://localhost:8881`
- **Theme dir**: `sportnza-theme/`
- **Node packages**: `package.json` at root (staticrypt for encryption)

## Architecture
```
sportnza-theme/          # WordPress theme (PHP templates + assets)
├── functions.php        # Main theme functions, asset enqueuing
├── header.php           # Site header with nav + language switcher
├── footer.php           # Site footer
├── front-page.php       # Homepage template
├── page-about.php       # About Us page template
├── style.css            # Main stylesheet
├── translations.json    # All translatable strings (DE, FR, IT, HU)
├── inc/
│   ├── i18n.php         # Translation helpers: sportnza_t(), sportnza_get_lang()
│   ├── theme-setup.php
│   ├── customizer.php
│   ├── widgets.php
│   └── template-tags.php
├── template-parts/
│   ├── hero.php
│   ├── feature-cards.php
│   ├── shape-the-game.php
│   ├── go-beyond.php
│   └── content-card.php
├── assets/
│   ├── js/main.js       # Client-side JS with _t() translation helper
│   ├── css/mobile-menu.css
│   └── images/          # SVGs, WebPs, hero banner
├── setup-content.php    # One-time content setup (access via ?sportnza_setup=1)

export-static.js         # Exports WP pages to static HTML (all 5 languages)
encrypt-pages.js         # Encrypts all static pages with StatiCrypt
static-export/           # Build artifact (gitignored) — intermediate output
docs/                    # Final deployment folder for GitHub Pages
```

## Multi-Language System
- **Languages**: EN (root `/`), DE (`/de/`), FR (`/fr/`), IT (`/it/`), HU (`/hu/`)
- **WordPress**: Uses `?lang=xx` query param
- **Static export**: Uses path-based URLs (`/de/`, `/fr/about/`, etc.)
- **Translation function**: `sportnza_t('English text')` in PHP, `_t('English text')` in JS
- **Translations file**: `sportnza-theme/translations.json` — keyed by English, values per language
- **JS translations**: Passed via `sportnzaData.translations` from `wp_localize_script`

## Deploy Workflow
1. `npx wp-now start --path=sportnza-theme` (must be running)
2. `node export-static.js` — downloads all 30 pages (6 pages × 5 languages), cleans WP artifacts, rewrites URLs
3. Copy `static-export/` → `docs/`
4. `node encrypt-pages.js` — encrypts all 30 pages in `docs/` with StatiCrypt
5. Commit `docs/` and push — GitHub Pages serves from `docs/` on `main`

## Password Protection
All pages are encrypted with StatiCrypt. Password is in `encrypt-pages.js`.

## GitHub Pages
- Serves from `docs/` folder on `main` branch
- Repo: `florindarie/sportaza`
