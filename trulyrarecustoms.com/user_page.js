window.addEventListener("DOMContentLoaded", () => {

const sections = ["products","messages","site","discounts","users","orders"];

sections.forEach(section=>{
  const el = document.getElementById(section);
  if(el){
    el.addEventListener("click", ()=> sendCategory(section));
  }
});

});

function sendCategory(section){

fetch('categories.php',{
method:'POST',
headers:{
'Content-Type':'application/x-www-form-urlencoded'
},
body:'section='+encodeURIComponent(section)
})
.then(res=>res.text())
.then(html=>{
document.getElementById('content').innerHTML = DOMPurify.sanitize(html);
});

}



document.addEventListener("click",(e)=>{

/* ---------- ADD DISCOUNT ---------- */

if(e.target.id === "add_discounts"){

popup(`
<h1>Edit</h1>

<form class="popupContentWords" action="./adminDiscountAdd.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id">

<label>Name:</label><br>
<input class="emb" type="text" name="name" required><br><br>

<label>Code:</label><br>
<input class="emb" type="text" name="code" required><br><br>

<label>Exp:</label><br>
<input class="emb" type="date" name="exp" required><br><br>

<label>Percent:</label><br>
<input class="emb" type="tel" name="percent"><br><br>

<label>Amount:</label><br>
<input class="emb" type="text" name="amount"><br><br>

<button type="button" class="catEditCancel">Cancel</button>
<button class="emsb catEditSubmit" type="submit">Submit</button>

</form>
`);

}


/* ---------- ADD PRODUCT ---------- */

if(e.target.id === "add_products"){

popup(`
<h1>Edit</h1>

<form class="popupContentWords" action="./adminProductAdd.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id">

<label>Name:</label><br>
<input class="emb" type="text" name="name" required><br><br>

<label>Description:</label><br>
<input class="emb" type="text" name="description" required><br><br>

<input type="hidden" name="image">

${[...Array(10)].map((_,i)=>`<input type="file" name="file${i}">`).join("")}

<br><br>

<label>Price:</label><br>
<input class="emb" type="tel" name="price" required><br><br>

<label>Currency:</label><br>
<input class="emb" type="text" name="currency" required><br><br>

<label>SKU:</label><br>
<input class="emb" type="text" name="sku" required><br><br>

<label>Tags:</label><br>
<input class="emb" type="text" name="tags" required><br><br>

<label>Stock (JSON):</label><br>
<input class="emb" type="text" name="stock"
value='{"XS":0,"S":0,"M":0,"L":0,"XL":0,"2XL":0,"3XL":0}'
required><br><br>

<label>Visible?</label><br>
<select class="emb" name="visible">
<option value="yes">Yes</option>
<option value="no">No</option>
</select>

<br><br>

<button type="button" class="catEditCancel">Cancel</button>
<button class="emsb catEditSubmit" type="submit">Submit</button>

</form>
`);

}


/* ---------- EDIT BUTTON ---------- */

if(e.target.classList.contains("edit-button")){

const record = e.target.closest(".record");
const id = e.target.id;

if(!record) return;

const data = {...record.dataset};

/* ---------- PRODUCTS ---------- */

if(id.startsWith("products_")){

popup(`

<h1>Edit</h1>

<form class="popupContentWords" action="/productChanges.php?id=${data.id}" method="POST">

<p>id: ${data.id}</p>

<input type="hidden" name="id" value="${data.id}">

<input class="emb" name="name" value="${data.name || ""}" placeholder="name"><br><br>

<input class="emb" name="description" value="${data.description || ""}" placeholder="description"><br><br>

<input class="emb" name="image" value="${data.image || ""}" placeholder="image"><br><br>

<input class="emb" name="price" value="${data.price || ""}" placeholder="price"><br><br>

<input class="emb" name="currency" value="${data.currency || ""}" placeholder="currency"><br><br>

<input class="emb" name="tags" value="${data.tags || ""}" placeholder="tags"><br><br>

<input class="emb" name="stock" value="${data.stock || ""}" placeholder="stock"><br><br>

<p>sku: ${data.sku}</p>

<label>Visible?</label>

<select class="emb" name="visible">
<option value="yes">Yes</option>
<option value="no">No</option>
</select>

<br><br>

<button type="button" class="catEditDelete">Delete</button>
<button type="button" class="catEditCancel">Cancel</button>
<button class="emsb catEditSubmit" type="submit">Submit</button>

</form>
`);

}


/* ---------- DELETE PRODUCT ---------- */

document.addEventListener("click",(ev)=>{

if(ev.target.classList.contains("catEditDelete")){

fetch('./adminProductDelete.php',{
method:'POST',
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:'id='+encodeURIComponent(data.id)
})
.then(res=>res.text())
.then(()=> location.reload());

}

});

}

});



/* ---------- POPUP FUNCTION ---------- */

function popup(content){

const el = document.getElementById("content");

el.insertAdjacentHTML("afterbegin",`

<div id="popupScrollWrapper">

<div id="promptText">

${content}

</div>

</div>

`);

document.querySelectorAll(".catEditCancel").forEach(btn=>{
btn.onclick=()=> document.getElementById("popupScrollWrapper")?.remove();
});

}