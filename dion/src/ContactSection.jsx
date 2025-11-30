import React from "react";

export default function ShopSection() {
  return (
    <div className="all">
    <div className="section contact-section">
      <h1>Contact</h1>

      <div className="contact-content">

        <div className="contact-info">
          <p className="placeholder-line"></p>
          <p className="placeholder-line"></p>
          <p className="placeholder-line short"></p>
          <p className="placeholder-line"></p>
          <p className="placeholder-line"></p>
        </div>

        <div className="contact-image-placeholder"></div>
      </div>


      <form className="contact-form">
        <input type="text" placeholder="Your Name" className="form-input" />
        <input type="email" placeholder="Your Email" className="form-input" />
        <textarea placeholder="Your Message" className="form-textarea"></textarea>

        <button className="primary-btn">Submit</button>
      </form>
    </div>
    </div>
  );
}



