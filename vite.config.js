import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/edit.js',
                'resources/js/play.js',
                'resources/js/stacks.js',
                'resources/js/stats.js',
            ],
            refresh: true,
        }),
    ],
});
