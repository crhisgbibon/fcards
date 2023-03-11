import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'resources/js/vh.js',

                'resources/js/decks.js',
                'resources/js/play.js',
                'resources/js/stacks.js',
                'resources/js/stats.js',

                'resources/css/decks.css',
                'resources/css/play.css',
                'resources/css/stacks.css',
                'resources/css/stats.css',
            ],
            refresh: true,
        }),
    ],
});
