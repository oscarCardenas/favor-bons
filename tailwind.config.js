const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                primary1:    '#011b32',
                primary2:    '#baf241',
                white:       '#ffffff',
                secondary1:  '#012746',
                secondary2:  '#22394d',
                secondary3:  '#75797F',
                borderInput: '#87bf0d'
            },
            fontFamily: {
                Lato: "'Lato', sans-serif;"
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
