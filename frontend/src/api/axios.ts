import axios from "axios";

const api = axios.create({
  baseURL: "http://127.0.0.1:8001/api",
  withCredentials: true, // For cookie/session auth
});

export default api;
