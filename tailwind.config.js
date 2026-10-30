/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./resources/views/**/*.blade.php'],
  theme: {
    extend: {
      colors: {
        brand: { DEFAULT: '#2f6f5e', dark: '#24584a', soft: '#e3efeb' },
      },
    },
  },
  plugins: [],
};
