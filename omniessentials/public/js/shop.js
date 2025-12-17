document.addEventListener("DOMContentLoaded", function() {
const buyButton = document.getElementsByClassName("buy");
const xButton = document.getElementsByClassName("X");
const checkoutButton = document.getElementsByClassName("checkout-button")[0];
// Buy Button Event Listener
for (let i = 0; i < buyButton.length; i++) {
    buyButton[i].addEventListener("click", function() {
        let itemName = this.getAttribute("data-item-name");
    });
    }
    // X Button Event Listener
for (let i = 0; i < xButton.length; i++) {
    xButton[i].addEventListener("click", function() {
        let itemName = this.getAttribute("data-item-name");
        document.cookie = itemName + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
        location.reload();
    });
    }

// Checkout Button Event Listener
    checkoutButton.addEventListener("click", function() {
        let cookies = document.cookie.split(";");
        cookies = cookies.map(name => name.replace(/^Cart_/, ''));
        window.location.href = "checkout.php?items=" + cookies.join(",");
    });
});