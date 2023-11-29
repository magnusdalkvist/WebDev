/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["../views/*.php"],
  theme: {
    extend: {
      colors: {
        sexyred: "#D7472C",
        "sexyred-dark": "#B83A26",
        "sexyred-light": "#E55A40",
      },
    },
  },
  plugins: [],
  darkMode: "class",
};
