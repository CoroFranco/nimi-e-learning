import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/normalize.css', 'resources/js/inicioSesion.js', 'resources/js/bootstrap.js', 'resources/js/profile.js'],
            refresh: true,
        }),
    ],
    server: {
        strictPort: true,
        https: true, // Asegura que se use HTTPS
    },
    base: '/', // Asegura que Vite use rutas relativas
});
