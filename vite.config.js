import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/normalize.css', 'resources/js/inicioSesion.js', 'resources/js/bootstrap.js', 'resources/js/profile.js'],
            refresh: true,
        }),
    ],
});
