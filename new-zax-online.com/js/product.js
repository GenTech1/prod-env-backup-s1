const thumbnails = document.querySelectorAll('.thumbnail');
const buyButton = document.getElementById('buyNowButton');
const paymentForm = document.getElementById('payment-form');
const cancelButton = document.getElementById('cancel-button');

cancelButton.addEventListener('click', function() {
    paymentForm.style.display = 'none';
});
buyButton.addEventListener('click', function() {
    paymentForm.style.display = 'flex';
});

thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('click', function() {
        let mainImage = document.getElementById('productImage');
        mainImage.src = this.src;
    });
});