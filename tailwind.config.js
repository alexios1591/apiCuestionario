/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      backgroundImage : {
        'fondo': 'linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);'
      }
    },
  },
  plugins: [],
}

