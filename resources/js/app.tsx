import { createInertiaApp } from '@inertiajs/react';
import type { ComponentType } from 'react';
import { createRoot } from 'react-dom/client';

const pages = import.meta.glob<{ default: ComponentType }>('./Pages/**/*.tsx');

createInertiaApp({
    resolve: async (name) => {
        const page = pages[`./Pages/${name}.tsx`];

        if (!page) {
            throw new Error(`Página Inertia não encontrada: ${name}`);
        }

        return (await page()).default;
    },
    setup({ el, App, props }) {
        if (!el) {
            return;
        }

        createRoot(el).render(<App {...props} />);
    },
    progress: {
        color: '#1f4f35',
    },
});
