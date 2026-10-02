import {
  BrowserRouter as Router,
  Routes,
  Route,
} from "react-router-dom";

// import SiteTopBar from "./components/SiteTopBar";
import SiteHeader from "./components/SiteHeader";
import SiteFooter from "./components/SiteFooter";

import HomePage from "./components/HomePage";
import AboutPage from "./components/AboutPage";
import ActionsPage from "./components/ActionsPage";
import ContactPage from "./components/ContactPage";
import CallToActionPage from "./components/CallToActionPage";

function App() {
  return (
    <Router>
      <div className="flex flex-col min-h-screen">

        {/* <SiteTopBar /> */}

        <SiteHeader />

        <main className="flex-grow">

          <Routes>

            {/* Accueil */}
            <Route
              path="/"
              element={<HomePage />}
            />

            {/* À propos */}
            <Route
              path="/a-propos"
              element={<AboutPage />}
            />

            {/* Nos actions */}
            <Route
              path="/nos-actions"
              element={<ActionsPage />}
            />

            {/* Agir avec nous */}
            <Route
              path="/call-to-action"
              element={<CallToActionPage />}
            />

            {/* Contact général */}
            <Route
              path="/contact"
              element={<ContactPage />}
            />

          </Routes>

        </main>

        <SiteFooter />

      </div>
    </Router>
  );
}

export default App;