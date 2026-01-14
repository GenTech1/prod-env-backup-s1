
let showing = 0;
const promptText = document.getElementById("promptText");
const prompt = document.getElementById("prompt");
const track = document.getElementById("bannerTrack");
const nextArrow = document.getElementById("nextArrow");
const previousArrow = document.getElementById("previousArrow");
window.onload = function() {
prompt.style.display="block"
promptText.style.display="block"
document.getElementById("smsCancel").addEventListener("click", ()=>{
  document.getElementById("prompt").style.display = "none";
  document.getElementById("promptText").style.display = "none";
});
  setTimeout(function() {
    roll();
    setInterval(roll, 5000);
  }, 5000);
};
nextArrow.addEventListener("click",roll);
previousArrow.addEventListener("click",rollBackwards);
function rollBackwards() {
    if(showing == 0){
        track.style.transform = "translateX(-200vw)";
        showing = 2;
    }else if(showing == 1){
    track.style.transform = "translateX(0vw)";
    showing = 0;
    }else if(showing == 2){
    track.style.transform = "translateX(-100vw)";
    showing = 1;
    }
}
function roll() {
    if(showing == 0){
        track.style.transform = "translateX(0vw)";
        showing++;
    }else if(showing == 1){
    track.style.transform = "translateX(-100vw)";
    showing++;
    }else if(showing == 2){
    track.style.transform = "translateX(-200vw)";
    showing = 0;
    }


}

  
    

