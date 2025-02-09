import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/normalize.css',
                'resources/js/inicioSesion.js',
                'resources/js/bootstrap.js',
                'resources/js/profile.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        https: true,
    },
    // Usa una URL dinámica basada en el ambiente
    base: process.env.APP_URL || 'https://nimi-e-learning-production.up.railway.app',
});
