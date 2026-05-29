document.addEventListener("DOMContentLoaded", function() {
    const buyButton = document.getElementsByClassName("buy");
    const xButton = document.getElementsByClassName("X");
    const checkoutButton = document.getElementsByClassName("checkout-button")[0];

    // --- CART UI LOGIC ---

    // Buy Individual Item Button
    for (let i = 0; i < buyButton.length; i++) {
        buyButton[i].addEventListener("click", function() {
            let item = this.getAttribute("data-item-name");
            item = item.replace(/_Buy$/, '').replace(/^Cart_/, '');
            window.location.href = "checkout.php?item=" + item;
        });
    }

    // X (Remove) Button
    for (let i = 0; i < xButton.length; i++) {
        xButton[i].addEventListener("click", function() {
            let item = this.getAttribute("data-item-name").replace(/_X$/, '');
            document.cookie = item + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
            location.reload();
        });
    }

    // Main Checkout Button
    if (checkoutButton) {
        checkoutButton.addEventListener("click", function() {
            window.location.href = "checkout.php";
        });
    }

    // --- PRODUCT INTERACTION LOGIC ---

    // 1. Handle Variation Price Updates
    // This looks for any select menu and updates the price display next to it
    document.querySelectorAll('.variant-select').forEach(select => {
        select.addEventListener('change', function() {
            const productDiv = this.closest('.product');
            const priceNum = productDiv.querySelector('.price-num');
            if (priceNum) {
                priceNum.innerText = this.value; // Option value is the price
            }
        });
    });

    // Helper function to get cookie value
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    // 2. Handle "Add to Cart" (ATC)
    document.querySelectorAll('.atc').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation(); // Stops the modal from opening
            
            const productDiv = this.closest('.product');
            const selector = productDiv.querySelector('.variant-select');
            
            let id, price;
            if (selector) {
                const selected = selector.options[selector.selectedIndex];
                id = selected.getAttribute('data-id');
                price = selected.value;
            } else {
                id = productDiv.dataset.id;
                price = productDiv.querySelector('.price-num').innerText;
            }

            // Clean id for cookie (should be numeric, but to be safe)
            const cookieName = "Cart_" + id;
            let currentValue = getCookie(cookieName);
            let qty = 1;
            if (currentValue) {
                const parts = currentValue.split('|');
                if (parts.length >= 3) {
                    qty = parseInt(parts[2]) + 1;
                }
            }
            const newValue = id + "|" + price + "|" + qty;
            document.cookie = cookieName + "=" + newValue + "; path=/; max-age=" + (30 * 24 * 60 * 60);
            
            alert("Item added to cart!");
            location.reload(); // Refresh to update the cart sidebar
        });
    });

    // 3. Image Modal / Gallery Logic
    document.querySelectorAll('.product').forEach(product => {
        product.addEventListener('click', () => {
            const images = JSON.parse(product.dataset.images || '{}');
            const printImage = product.dataset.print || '';
            
            const gallery = document.getElementById('gallery');
            const modal = document.getElementById('imageModal');
            const printEL = document.getElementById('printImage');

            gallery.innerHTML = '';

            // Build Gallery
            Object.values(images).forEach(img => {
                const fixed = img.replace(/\\/g, '/');
                const image = document.createElement('img');
                image.src = fixed;
                image.className = "modal-gallery-img"; // Added class for easier CSS styling
                image.style.width = '100%';
                image.style.marginBottom = '10px';
                gallery.appendChild(image);
            });

            // Set Print Image
            if (printImage) {
                printEL.src = printImage.replace(/\\/g, '/');
                printEL.style.display = 'block';
            } else {
                printEL.style.display = 'none';
            }

            modal.style.display = 'block';
            console.log("Viewing Product:", product.querySelector('.product-name').innerText);
        });
    });

    // Close Modal
    const closeBtn = document.querySelector('.close');
    if (closeBtn) { 
        closeBtn.onclick = (e) => {
            e.stopPropagation();
            document.getElementById('imageModal').style.display = 'none';
        };
    }

    // Close modal if clicking the dark background
    window.onclick = (event) => {
        const modal = document.getElementById('imageModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});