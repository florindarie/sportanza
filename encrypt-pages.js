const pathModule = require('path');
const fs = require('fs');

const cryptoEngine = require('./node_modules/staticrypt/lib/cryptoEngine.js');
const codec = require('./node_modules/staticrypt/lib/codec.js');
const { encodeWithHashedPassword } = codec.init(cryptoEngine);
const { generateRandomSalt } = cryptoEngine;
const {
  buildStaticryptJS,
  genFile,
  getFileContent,
} = require('./node_modules/staticrypt/cli/helpers.js');

const PASSWORD = 'Whydoialwaysforget!';
const TEMPLATE_PATH = pathModule.join(__dirname, 'node_modules', 'staticrypt', 'lib', 'password_template.html');

const languages = ['de', 'fr', 'it', 'hu'];

const basePages = [
  'index.html',
  'about/index.html',
  'category/sports/index.html',
  'category/academy/index.html',
  'category/news/index.html',
  'category/promotions/index.html',
];

// Build full page list: English at root + all language subfolders
const pages = [
  ...basePages.map(p => 'docs/' + p),
  ...languages.flatMap(lang => basePages.map(p => 'docs/' + lang + '/' + p)),
];

async function main() {
  const salt = generateRandomSalt();
  const hashedPassword = await cryptoEngine.hashPassword(PASSWORD, salt);

  const baseTemplateData = {
    is_remember_enabled: 'true',
    js_staticrypt: buildStaticryptJS(),
    template_button: 'DECRYPT',
    template_color_primary: '#00FF73',
    template_color_secondary: '#0E0F1D',
    template_error: 'Bad password!',
    template_instructions: '',
    template_placeholder: 'Password',
    template_remember: 'Remember me',
    template_title: 'Protected Page',
    template_toggle_show: 'Show',
    template_toggle_hide: 'Hide',
  };

  for (const page of pages) {
    console.log(`Encrypting ${page}...`);
    const contents = getFileContent(page);
    const encryptedMsg = await encodeWithHashedPassword(contents, hashedPassword);

    const staticryptConfig = {
      staticryptEncryptedMsgUniqueVariableName: encryptedMsg,
      isRememberEnabled: true,
      rememberDurationInDays: 30,
      staticryptSaltUniqueVariableName: salt,
    };

    const templateData = {
      ...baseTemplateData,
      staticrypt_config: staticryptConfig,
    };

    genFile(templateData, page, TEMPLATE_PATH);
  }

  console.log('\nAll pages encrypted with password!');
}

main().catch(console.error);
