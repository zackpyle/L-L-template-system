export default {
  format: [
    'tests/**/*.{php,js,jsx,json,ts,tsx,scss}'
  ],
  archive: {
    src: [
      'admin',
      // 'elandel',
      'framework',
      'integrations',
      'language',
      'logic',
      'loop',
      'modules',
    ],
    dest: 'publish/tangible-template-system.zip',
    exclude: [
      'src',
      'tests',
      'vendor'
    ],
    rootFolder: 'tangible-template-system'
  }
}
