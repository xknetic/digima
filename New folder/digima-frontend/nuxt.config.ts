import tailwindcss from "@tailwindcss/vite";

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false, // Disable server-side rendering
  compatibilityDate: "2024-11-01",
  devtools: { enabled: true },
  css: [
    "~/assets/css/main.css",
    "@vue-flow/core/dist/style.css",
    "@vue-flow/core/dist/theme-default.css",
  ],
  vite: {
    plugins: [tailwindcss()],
  },
  imports: {
    dirs: ["node_modules/@vue-flow/core"],
  },
});
