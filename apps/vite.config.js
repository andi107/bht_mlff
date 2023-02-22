import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/ts/dashboardmaps.js',
                'resources/js/sio/socket.io.min.js',
                'resources/js/pages/device.js',
                // 'resources/js/ts/maps.js',
                'resources/js/pages/geo.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            'sio': 'resources/js/sio/socket.io.min.js',
        },
    },
});
