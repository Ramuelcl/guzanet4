const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js'),
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],

    theme: {
        extend: {
            colors: {
                "pg-primary": colors.gray,
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                submenu: '0 2px 4px 0 rgba(0, 0, 0, 0.1)',
            },
            backgroundColor: {
                submenu: '#f7f7f7',
            },
            padding: {
                submenu: '1rem',
            },
            border: {
                submenu: '1px solid #ccc',
            },
            listStyleType: {
                disc: 'disc',
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms")({
            strategy: 'class',
        }),
        require('@tailwindcss/typography'),
    ],
};
