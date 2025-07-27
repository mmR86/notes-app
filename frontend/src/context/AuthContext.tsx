import { createContext, useContext, useState } from "react";
import { useNavigate } from "react-router-dom";

interface AuthContextType {
  token: string | null;
  login: (token: string) => void;
  logout: () => void;
  isAuthenticated: boolean;
}

//React context object created
const AuthContext = createContext<AuthContextType | undefined>(undefined);

//This is a context provider component that will wrap around parts of the app that needs auth state
export const AuthProvider = ({ children }: { children: React.ReactNode }) => {
  //token gets initilized by reading it from the local storage
  const [token, setToken] = useState<string | null>(() =>
    localStorage.getItem("token")
  );
  //useNavigate hook is used for redirection
  const navigate = useNavigate();

  //when the user logs in, token gets stored in local storage, state gets updated
  const login = (newToken: string) => {
    localStorage.setItem("token", newToken);
    setToken(newToken);
    navigate("/notes");
  };

  //Clears token and redirects to the login page
  const logout = () => {
    localStorage.removeItem("token");
    setToken(null);
    navigate("/login");
  };

  //Token is used to get a boolean value
  const isAuthenticated = !!token;

  return (
    <AuthContext.Provider value={{ token, login, logout, isAuthenticated }}>
      {children}
    </AuthContext.Provider>
  );
};

//with the context we also return a custom hook useAuth, which checks if the AuthContext is not undefined, than it returns  the context value:login,logout,token...
export const useAuth = () => {
  const context = useContext(AuthContext);
  if (context === undefined) {
    throw new Error("useAuth must be used within an AuthProvider");
  }
  return context;
};
