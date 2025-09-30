let buy = document.getElementById("buy");
let cart = document.getElementById("cart");
let size = document.querySelectorAll(".size");
let params = new URLSearchParams(window.location.search);
let sku = params.get('sku');
let checkoutURL = 'checkout.php?sku=' + encodeURIComponent(sku);
encodedSKU = encodeURIComponent(sku);
const date = new Date();


buy.addEventListener("submit", (e) =>{
e.preventDefault();
window.location.assign(checkoutURL);
});

for (let i = 0; i < size.length; i++) {
size[i].addEventListener("click", function (e) {
    e.preventDefault();

    let fullNameSize = this.dataset.name;
    let sizePicked = "-" + fullNameSize.split("-").pop();

    document.cookie = "picked=" + encodeURIComponent(sizePicked) + ";path=/"
    // Change this to size for line 40 and make it glouble

    if (sizePicked) {

    alert("The size you have pick was " + sizePicked);
    console.log ("The size you have pick was", );
    } else {
        alert("No size was pick!");
    }
});
}

cart.addEventListener("submit", (e) =>{
e.preventDefault();
date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
let expires = "expires=" +date.toUTCString();
document.cookie = ` CART_${encodedSKU}=${encodedSKU}_${size}; ${expires}; path =/`;
});
