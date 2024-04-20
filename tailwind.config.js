/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./dist/*.{html,js}"],
  theme: {
    extend: {
      colors:{
        primary: '#FF6363',
        secondary: { 
          100:'#E2E2D5',
          200:'#888883',
        }
      },
      gridTemplateRows: {
        // Simple 8 row grid
       'komo': '70px 1fr 70px',
      },
      gridTemplateColumns: {
        // Simple 8 row grid
       'komo': '70px 150px 50px 1fr',
      }
    },
  },
  plugins: [],
}

