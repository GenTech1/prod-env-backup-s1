export default function AboutSection() {
  return (
    <div className="all">
    <section className="about-section">

      <div className="about-wrapper">
        
        {/* LEFT TEXT SIDE */}
        <div className="about-text">
          <h1>About</h1>

          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <p>Suspendisse potenti. Donec accumsan risus ut felis euismod.</p>
          <p>Integer vel dui vitae lacus malesuada hendrerit.</p>
          <p>Etiam quis nisl tincidunt, dignissim libero nec, varius arcu.</p>

        </div>

        {/* RIGHT IMAGE BOX */}
        <div className="about-image box"></div>

      </div>

      {/* LOWER EXTRA TEXT AREA */}
      <div className="about-lower">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <p>Morbi pharetra lorem non turpis suscipit egestas.</p>
        <p>Donec condimentum libero eget nisl gravida aliquet.</p>
      </div>

    </section>
    </div>
  );
}
