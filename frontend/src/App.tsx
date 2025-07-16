import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import Notes from "./pages/Notes";
import Login from "./pages/Login";
import Register from "./pages/Register";

export default function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Notes />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
      </Routes>
    </Router>
  );
}
