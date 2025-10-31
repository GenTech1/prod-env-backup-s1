import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import * as fabric from 'fabric';
import {useState, useRef} from 'react';
function App() {
  const canvasRef = useRef(null);
const canvas = new fabric.Canvas(canvasRef.current);


  const addCircle =() => {

    const canvas = new fabric.Canvas(canvasRef.current);
    canvas.add(new fabric.Circle({radius: 50, fill: '#000000', left: 100, top: 100}));
    return () => {
      canvas.dispose();
    };
  }
  const addSquare =() => {

    const canvas = new fabric.Canvas(canvasRef.current);
    canvas.add(new fabric.Circle({radius: 50, fill: '#000000', left: 100, top: 100}));
    return () => {
      canvas.dispose();
    };
  }
  const whiteShirt =() => {
document.getElementById("shirtImg").src = "whiteShirt.jpg";


  }
  const redShirt =() => {
    document.getElementById("shirtImg").src = "redShirt.jpg";

  }

  return (
    <div className="App">
      <h1>Shirt Editor</h1>
      <div className="container">
        <img id="shirtImg" src="whiteShirt.jpg" alt="Shirt" style={{width: "100%", height: "100%"}} />
        <div style={{position: "absolute",  top:"10%"}}>

          <canvas width="260" height="280"
          ref={canvasRef}>

          </canvas>
        </div>
        </div>
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <div className="buttons" id="shapes">
        <button onClick={addCircle}>Circle</button>
        </div>
        <div className="buttons" id="colors">
        <button onClick={whiteShirt}>white</button>
        <button onClick={redShirt}>red</button>
        </div>
        
    </div>


  );
}

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);

