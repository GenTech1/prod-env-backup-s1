let buy = document.getElementById("buy");
let cart = document.getElementById("cart");
let params = new URLSearchParams(window.location.search);
let sku = params.get('sku');
let checkoutURL = 'checkout.php?sku=' + encodeURIComponent(sku);
encodedSKU = encodeURIComponent(sku);

buy.addEventListener("submit", (e) =>{
e.preventDefault();
window.location.assign(checkoutURL);
});
cart.addEventListener("submit", (e) =>{
e.preventDefault();
const date = new Date();
date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
let expires = "expires=" +date.toUTCString();
document.cookie = ` CART_${encodedSKU}=${encodedSKU}; ${expires}; path =/`;
});
