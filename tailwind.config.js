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
            colors: {
                primary: '#002819',
                'on-primary': '#ffffff',
                'primary-container': '#06402b',
                'on-primary-container': '#77ac90',
                'inverse-primary': '#9cd2b5',
                'primary-fixed': '#b8efd0',
                'primary-fixed-dim': '#9cd2b5',
                'on-primary-fixed': '#002114',
                'on-primary-fixed-variant': '#1b503a',

                secondary: '#086878',
                'on-secondary': '#ffffff',
                'secondary-container': '#a1ebfe',
                'on-secondary-container': '#136c7d',
                'secondary-fixed': '#a9edff',
                'secondary-fixed-dim': '#87d2e4',
                'on-secondary-fixed': '#001f26',
                'on-secondary-fixed-variant': '#004e5b',

                tertiary: '#1e2323',
                'on-tertiary': '#ffffff',
                'tertiary-container': '#333939',
                'on-tertiary-container': '#9da2a1',
                'tertiary-fixed': '#dee3e3',
                'tertiary-fixed-dim': '#c2c7c7',
                'on-tertiary-fixed': '#171d1c',
                'on-tertiary-fixed-variant': '#424847',

                error: '#ba1a1a',
                'on-error': '#ffffff',
                'error-container': '#ffdad6',
                'on-error-container': '#93000a',

                background: '#f9f9f7',
                'on-background': '#1a1c1b',
                surface: '#f9f9f7',
                'on-surface': '#1a1c1b',
                'surface-dim': '#dadad8',
                'surface-bright': '#f9f9f7',
                'surface-container-lowest': '#ffffff',
                'surface-container-low': '#f4f4f1',
                'surface-container': '#eeeeec',
                'surface-container-high': '#e8e8e6',
                'surface-container-highest': '#e2e3e0',
                'surface-variant': '#e2e3e0',
                'on-surface-variant': '#404943',
                'inverse-surface': '#2f3130',
                'inverse-on-surface': '#f1f1ef',

                outline: '#717973',
                'outline-variant': '#c0c9c1',
                'surface-tint': '#356850',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Merriweather', ...defaultTheme.fontFamily.serif],
                display: ['Inter', ...defaultTheme.fontFamily.sans],
                headline: ['Inter', ...defaultTheme.fontFamily.sans],
                ui: ['Inter', ...defaultTheme.fontFamily.sans],
                article: ['Merriweather', ...defaultTheme.fontFamily.serif],
                caption: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'display-lg': ['48px', { lineHeight: '1.2', letterSpacing: '-0.02em', fontWeight: '700' }],
                'display-lg-mobile': ['32px', { lineHeight: '1.2', letterSpacing: '-0.01em', fontWeight: '700' }],
                'headline-md': ['32px', { lineHeight: '1.3', fontWeight: '600' }],
                'headline-sm': ['24px', { lineHeight: '1.4', fontWeight: '600' }],
                'article-body': ['18px', { lineHeight: '1.8', fontWeight: '400' }],
                'article-body-mobile': ['16px', { lineHeight: '1.7', fontWeight: '400' }],
                'ui-label': ['14px', { lineHeight: '1', letterSpacing: '0.02em', fontWeight: '500' }],
                caption: ['12px', { lineHeight: '1.4', fontWeight: '400' }],
            },
            spacing: {
                base: '8px',
                'container-max': '1280px',
                gutter: '24px',
                'margin-desktop': '64px',
                'margin-mobile': '20px',
                'section-gap': '80px',
            },
            borderRadius: {
                sm: '0.25rem',
                DEFAULT: '0.5rem',
                md: '0.75rem',
                lg: '1rem',
                xl: '1.5rem',
                full: '9999px',
            },
            maxWidth: {
                'container-max': '1280px',
            },
            minHeight: {
                'screen-blog': 'max(884px, 100dvh)',
            },
        },
    },

    plugins: [forms],
};
