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
        clearMocks: true,
        environment: 'jsdom',
        environmentOptions: {
            jsdom: {
                url: 'http://localhost',
            },
        },
        globals: true,
        include: ['resources/js/**/*.test.{ts,tsx}'],
        restoreMocks: true,
        setupFiles: ['./resources/js/test/setup.ts'],
    },
});
