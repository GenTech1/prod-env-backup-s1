document.addEventListener("DOMContentLoaded", () => {
const atc = document.getElementsByClassName("atc");
for(i=0;i<atc.length;i++){
atc[i].addEventListener("click", ()=>{
        const product = e.target.closest("div").querySelector('[name="product-name"]');
        if (product) alert(product.textContent);
});
}
});
