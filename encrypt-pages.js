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

const pages = [
  'docs/index.html',
  'docs/about/index.html',
  'docs/category/sports/index.html',
  'docs/category/academy/index.html',
  'docs/category/news/index.html',
  'docs/category/promotions/index.html',
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
