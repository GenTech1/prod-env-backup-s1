let buy = document.getElementById("buy");
let cart = document.getElementById("cart");
let cartBtn = document.getElementById("cartBtn");
let size = document.querySelectorAll(".size");
let params = new URLSearchParams(window.location.search);
let sku = params.get('sku');
let checkoutURL = 'checkout.php?sku=' + encodeURIComponent(sku);
encodedSKU = encodeURIComponent(sku);
const date = new Date();
let sizePicked = '';


buy.addEventListener("submit", (e) =>{
e.preventDefault();
window.location.assign(checkoutURL);
});

document.getElementById("cartBtn").addEventListener("click", function (e){
    if (!sizePicked) {
        e.preventDefault();
    // alert("The size you have picked was " + sizePicked);
    alert("No size was picked!");
    }
});

for (let i = 0; i < size.length; i++) {
size[i].addEventListener("click", function (e) {
    e.preventDefault();

    let fullNameSize = this.dataset.name;
    sizePicked = "-" + fullNameSize.split("-").pop();

    // alert("The size you have picked was " + sizePicked);
    // console.log ("The size you have picked was", sizePicked);
});
}

cart.addEventListener("submit", (e) =>{
e.preventDefault();
date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
let expires = "expires=" +date.toUTCString();
document.cookie = ` CART_${encodedSKU}=${encodedSKU}${sizePicked}; ${expires}; path =/`;
});
// document.cookie = ` CART_${encodedSKU}=${encodedSKU}${sizePicked}; ${expires}; path =/`;
