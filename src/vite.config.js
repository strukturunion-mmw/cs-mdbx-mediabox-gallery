import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        https: true,
        host: "0.0.0.0",
        port: "5173",
        hmr: {
            host: 'strukturunion-mmw-musical-space-goggles-55qvr5g6pqr249p-5173.preview.app.github.dev'
        },
      },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
