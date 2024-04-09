import {defineConfig} from "vite";
import {resolve} from "node:path";
export default defineConfig({
    build: {
        lib: {
            entry: resolve(__dirname, './scripts/main.ts'),
            name: 'main',
            fileName: 'main'
        }
    }
});