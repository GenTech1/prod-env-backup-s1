let Hb = document.getElementById("HbMenu");
let nav = document.getElementById("nav");
let usrOps = document.getElementById("usrOps");
let hLogo = document.getElementById("homeLogo");
let searchSwitch = 0;
let searchButton = document.getElementById("searchButton")
let checkoutButton = document.getElementById("checkoutBtn");
let emailSubmit = document.getElementById("emailSubmit");


hLogo.addEventListener("click", function (){
    window.location.href = "index.php";

})
Hb.addEventListener("click", function () { 
if(nav.style.display === "flex"){
    nav.style.display = "none"
    usrOps.style.display = "flex"

}else{
    nav.style.display = "flex"
        usrOps.style.display = "none"
}
});

searchButton.addEventListener("click" , () => {
if(searchSwitch == 0){
usrOps.insertAdjacentHTML("afterbegin", '<input id="searchBar" type="text"/>');
searchSwitch = 1;
}else if(searchSwitch == 1){
const searchBar = document.getElementById("searchBar");
if(searchBar){ searchBar.remove();}
searchSwitch = 0;
}

})
document.addEventListener("keydown", (event) =>{
const searchBar = document.getElementById("searchBar");

if(searchBar && document.activeElement === searchBar && event.key === "Enter"){
let word = searchBar.
value.trim();
if(word.length < 1 || word.length > 50 || !/^[a-zA-Z]+$/.test(word)){
    alert("Please enter a search term with between 1-50 letters.");
    return;
}
window.location.href = "results.php?word=" + encodeURIComponent(word);
}
})
