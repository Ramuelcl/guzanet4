import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig(
    {
        server: {
            /* quita pantalla de error [postcss] Cannot find module 'daisyui'*/
            hmr: { overlay: true }

        }, plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/css/custom-styles.css',
                    'resources/js/app.js',
                ],
                refresh: [
                    ...refreshPaths,
                    'app/Http/Livewire/**',
                ],
            }),
        ],

    });
