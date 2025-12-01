
export default function HomeSection({ setScreen }){
  return (
    <>
        <div className="all">
        <section className="home-section">
          <div className="hero-text">
              <h1>Coffee Cups<br />& Mugs</h1>
              <p>Shop our collection of coffee cups and mugs with unique designs.</p>
              <button className="btn"onClick={() => setScreen("shop")}>Shop Now</button>
          </div>

          <div className="hero-image box">
              <img src="" alt="Mug Icon" />
          </div>
      </section><section className="featured">
              <h2>Featured Products</h2>

              <div className="product-grid">
                  <div className="product box"></div>
                  <div className="product box"></div>
                  <div className="product box"></div>
              </div>
          </section><section className="about">
              <div className="about-left">
                  <h2>About Us</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut arcu sed velit.</p>
              </div>
              <div className="about-right">
                  <button className="btn" onClick={() => setScreen("about")}>Learn More</button>
              </div>
          </section>
          </div>
          </>
          
  );
}
