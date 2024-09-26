import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: "public/build",
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    let extension = assetInfo.name.split('.').slice(-1);
                    if (!extension) {
                        extension = 'compiled';
                    }
                    if (/png|jpe?g|webp|gif/i.test(extension)) {
                        extension = 'images';
                    }
                    if (/svg/i.test(extension)) {
                        extension = 'icon';
                    }
                    if (/woff|woff2|eot|ttf/i.test(extension)) {
                        extension = 'fonts';
                    }
                    return `${extension}/[name].[hash][extname]`;
                },
                chunkFileNames: 'js/chunks/[name]-[hash].js',
                entryFileNames: 'js/[name].[hash].js'
            }
        },
        sourcemap: false,
        manifest: "manifest.json",
        minify: 'esbuild'
    },
});
