import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import { defineConfig } from 'vitest/config';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            refresh: true,
        }),
        react(),
    ],
    test: {
        environment: 'jsdom',
        setupFiles: ['./resources/js/test/setup.ts'],
    },
});
