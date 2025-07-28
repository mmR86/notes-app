import { NavLink } from "react-router-dom";
import { useAuth } from "../context/AuthContext";

const Navbar = () => {
  const isTrue =
    "text-white bg-black hover:bg-indigo-600 hover:text-white rounded-md px-3 py-2 transition-colors ease-in-out";
  const isFalse =
    "text-white hover:bg-indigo-500 hover:text-white rounded-md px-3 py-2 transition-colors ease-in-out";

  const { isAuthenticated } = useAuth();

  return (
    <>
      <nav className="bg-indigo-700 border-b border-indigo-500">
        <div className="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
          <div className="flex h-20 items-center justify-start gap-4">
            <NavLink
              className={({ isActive }) => (isActive ? isTrue : isFalse)}
              to="/"
            >
              Home
            </NavLink>
            {!isAuthenticated ? (
              <>
                <NavLink
                  className={({ isActive }) => (isActive ? isTrue : isFalse)}
                  to="/login"
                >
                  Login
                </NavLink>
                <NavLink
                  className={({ isActive }) => (isActive ? isTrue : isFalse)}
                  to="/Register"
                >
                  Register
                </NavLink>
              </>
            ) : (
              <>
                <NavLink
                  className={({ isActive }) => (isActive ? isTrue : isFalse)}
                  to="/notes"
                >
                  Notes
                </NavLink>
                <NavLink
                  className={({ isActive }) => (isActive ? isTrue : isFalse)}
                  to="/logout"
                >
                  Logout
                </NavLink>
              </>
            )}
          </div>
        </div>
      </nav>
    </>
  );
};

export default Navbar;
