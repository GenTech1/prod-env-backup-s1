document.getElementsByClassName("btn light")[0].addEventListener("click", () => {
            let canvas = document.createElement("canvas")
            canvas.width = 600;
            canvas.height = 600;
            container.appendChild(canvas);

            let submit_confetti = confetti.create(canvas);
            submit_confetti().then(() => container.removeChild(canvas));
          });
