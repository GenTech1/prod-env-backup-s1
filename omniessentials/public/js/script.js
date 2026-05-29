document.addEventListener("DOMContentLoaded", () => {
        
const atc = document.getElementsByClassName("atc");
for(i=0;i<atc.length;i++){
atc[i].addEventListener("click", (e)=>{

        
    const productCard = e.target.closest(".product");
    const productName = productCard.querySelector(".product-name").textContent;
    const cookieName = "Cart_" + productName.replace(/\s+/g, '_').toLowerCase();

document.cookie = `${cookieName}=;path=/;expires=Thu, 01 Jan 197000:00:00 UTC`;
window.location.reload();

});

}
});
