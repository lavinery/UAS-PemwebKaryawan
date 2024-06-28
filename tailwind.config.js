import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php', './storage/framework/views/*.php', './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    'Figtree',
                    ...defaultTheme.fontFamily.sans
                ]
            }
        }
    },
    daisyui: {
        themes: [
            {
                mytheme: {
                    "primary": "#8ceae5",
                    "secondary": "#8119b5",
                    "accent": "#cbed90",
                    "neutral": "#21313b",
                    "base-100": "#e4e4e7",
                    "info": "#607bf6",
                    "success": "#1e9f54",
                    "warning": "#fab005",
                    "error": "#f66060"
                }
            },
        ]
    },

    plugins: [require("daisyui")]
};
