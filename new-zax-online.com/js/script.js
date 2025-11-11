let Hb = document.getElementById("HbMenu");
let nav = document.getElementById("nav");

Hb.addEventListener("click", function (e) { 
    e.preventDefault();
if(nav.style.display === "flex"){
    nav.style.display = "none";


}else{
    nav.style.display = "flex";


}
});