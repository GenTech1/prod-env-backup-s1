import React from "react";

export default function ShopSection() {
  return (
    <div className="all">
    <div className="shop-section">

      {/* SECTION TITLE */}
      <h1 className="section-title">Shop</h1>

      <div className="shop-content">

        {/* LEFT: PRODUCT GRID */}
        <div className="product-grid">
          {Array(5).fill(0).map((_, i) => (
            <div className="product-card" key={i}>
              <div className="product-image">
                <div className="hero-image box">
              <img src="" alt="Mug Icon" />
          </div>
                <div className="mug-icon"></div>
              </div>
              
              <p className="product-name">Product</p>
              <p className="product-price">$19.99</p>
            </div>
          ))}
        </div>

        {/* RIGHT: CART BOX */}
        <div className="cart-box">
          <h2 className="section-title">Cart</h2>

          <div className="cart-lines">
            <div className="cart-line"></div>
            <div className="cart-line short"></div>
          </div>

          <h2 className="section-title">Total</h2>

          <div className="cart-lines">
            <div className="cart-line"></div>
            <div className="cart-line short"></div>
          </div>

          <button className="checkout-button">Checkout</button>
        </div>
        </div>\
        </div>    
        </div>
  );
}

