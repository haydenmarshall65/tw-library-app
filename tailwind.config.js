import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        "./resources/views/**/*.blade.php",
        "./resources/**/*{.vue,.js,.ts,.jsx,.tsx}",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'almond': {
                    DEFAULT: '#EADDCA'
                },
                'tan': {
                    DEFAULT: '#F5DEB3'
                },
                'coffee': {
                    DEFAULT: '#6F4E37'
                }
            }
        },
    },

    plugins: [forms],
};
