module.exports = {
  content: [
    './resources/**/*.blade.php',
  ],
  theme: {
    extend: {
      screens: {
        'print': { 'raw': 'print' },
    }
    },
  },
  plugins: [],
}
