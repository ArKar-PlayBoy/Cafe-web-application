import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f0fff4',
                    100: '#d0f0d7',
                    200: '#b0e2b9',
                    300: '#90d49b',
                    400: '#70c67d',
                    500: '#50b85f',
                    600: '#409f4d',
                    700: '#307a3e',
                    800: '#205a2f',
                    900: '#103520',
                },
            },
        },
    },

    plugins: [forms],
};
