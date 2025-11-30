// App.js
import { useState } from "react";
import HomeSection from "./HomeSection";
import AboutSection from "./AboutSection";
import ShopSection from "./ShopSection";
import ContactSection from "./ContactSection";

export default function App() {
  const [screen, setScreen] = useState("home");

  return (
    <div>
      {/* NAVBAR */}
      <header className="navbar">
        <div className="logo" onClick={() => setScreen("home")}>LOGO</div>
        <nav>
          <button onClick={() => setScreen("home")} className="nav-btn">Home</button>
          <button onClick={() => setScreen("about")} className="nav-btn">About</button>
          <button onClick={() => setScreen("shop")} className="nav-btn">Shop</button>
          <button onClick={() => setScreen("contact")} className="nav-btn">Contact</button>
        </nav>
      </header>
      {/* CONDITIONAL RENDERING */}
      {screen === "home" && <HomeSection setScreen={setScreen} />}
      {screen === "about" && <AboutSection />}
      {screen === "shop" && <ShopSection />}
      {screen === "contact" && <ContactSection />}
      <br />
      <section className="signup-section">
              <button className="btn light">Sign Up</button>
          </section>
      </div>
  );
}
