const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'class', // Enables dark mode via class
    theme: {
        extend: {
            colors: {
                agriculture: {
                    light: '#E3FCEC',
                    DEFAULT: '#10B981',
                    dark: '#064E3B',
                    brown: '#7F5539',
                    yellow: '#ECD444',
                    soil: '#4B3F2F',
                },
                slate: colors.slate,
                emerald: colors.emerald,
            },
        },
    },
    plugins: [],
}
