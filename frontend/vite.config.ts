import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

// https://vite.dev/config/
export default defineConfig({
  plugins: [react()],
  server: {
    port: 5173,
    proxy: {
      // optional if you're connecting to Laravel API
      "/api": "http://localhost:8000",
    },
  },
});
