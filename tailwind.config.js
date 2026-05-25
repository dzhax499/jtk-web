/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",
    "./app/Filament/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        navy: {
          50: '#f0f4f8',
          100: '#d9e2f0',
          200: '#b0c5e3',
          300: '#7fa7d6',
          400: '#5b8ec4',
          500: '#1a3a70',
          600: '#0f2a5c',
          700: '#0a1f48',
          800: '#051535',
          900: '#020b22',
        },
        'navy-dark': '#051535',
        'sky-light': '#4ec9f0',
        'sky-bright': '#00d4ff',
      },
      fontFamily: {
        sans: ['Instrument Sans', 'system-ui', 'sans-serif'],
      },
      boxShadow: {
        'card': '0 2px 8px rgba(0, 0, 0, 0.1)',
        'card-hover': '0 4px 16px rgba(0, 0, 0, 0.15)',
      },
    },
  },
  plugins: [],
}
