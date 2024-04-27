/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./views/**/*.twig"
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    1: '#FBDE4D',
                    2: '#59F9BE',
                    3: '#CBE7EF',
                    4: '#D3FE57'
                }
            },
            fontFamily: {
                'walter-turncoat': ['Walter Turncoat', 'arial'],
                inter: ['Inter Variable', 'arial'],
                viga: ['Viga', 'arial']
            },
        },
    },
    plugins: [],
}

