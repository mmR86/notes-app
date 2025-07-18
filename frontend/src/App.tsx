import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import Notes from "./pages/Notes";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Home from "./pages/Home";
import MainLayout from "./layouts/MainLayout";

export default function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<MainLayout />}>
          <Route index element={<Home />} />
          <Route path="/notes" element={<Notes />} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
        </Route>
      </Routes>
    </Router>
  );
}
