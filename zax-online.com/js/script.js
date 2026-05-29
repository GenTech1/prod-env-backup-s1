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

function book(){
    window.location.href = "book.php";
}
function shop(){
    window.location.href = "gaming.php";
    //will go to shop page when it is done for now it will just refresh the gaming page for we do not have enough items to fill the shop page anyway
    //window.location.href = "shop.php";
}
function shop2(){
    window.location.href = "workstations.php";
    //will go to shop page when it is done for now it will just refresh the workstations page for we do not have enough items to fill the shop page anyway
    //window.location.href = "shop.php";
}