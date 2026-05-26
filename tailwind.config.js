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
                'mentify-light': '#F8FAFC',
                'mentify-dark': '#0F172A',
                'mentify-blue': '#2563EB',
                'mentify-navy': '#1E3A8A',
                'mentify-amber': '#F59E0B',
            },
        },
    },

    plugins: [forms],
};
