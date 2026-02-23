document.addEventListener("DOMContentLoaded", function() {
const buyButton = document.getElementsByClassName("buy");
const xButton = document.getElementsByClassName("X");
const checkoutButton = document.getElementsByClassName("checkout-button")[0];
// Buy Button Event Listener
for (let i = 0; i < buyButton.length; i++) {
    buyButton[i].addEventListener("click", function() {
        let item = this.getAttribute("data-item-name");
        item = item.replace(/_Buy$/, '');
        item = item.replace(/^Cart_/, '');
        window.location.href = "checkout.php?item=" + item;
    });
    }
    // X Button Event Listener
for (let i = 0; i < xButton.length; i++) {
    xButton[i].addEventListener("click", function() {
        let item = this.getAttribute("data-item-name");
        item = item.replace(/_X$/, '');
        document.cookie = item + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
        location.reload();
    });
    }

// Checkout Button Event Listener
    checkoutButton.addEventListener("click", function() {
        let cookies = document.cookie.split(";").map(c => c.trim()) .filter(name => name.startsWith("Cart_")).map(c => c.replace(/^Cart_/, ""));
        cookies = cookies.map(name => name.replace(/=/, ''));
        window.location.href = "checkout.php?items=" + cookies.join(",");
        
    });
});