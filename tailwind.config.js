import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
                main: {
                    DEFAULT: '#313131',
                    light: '#414141',
                    dark: '#212121',
                    contrast: '#fafafa',
                    emphasis: '#dc2626',
                }
            }
        },
    },

    plugins: [forms],
};
