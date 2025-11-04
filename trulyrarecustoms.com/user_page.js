window.addEventListener("DOMContentLoaded",() =>{

let productsOp = document.getElementById("products");
let messagesOp = document.getElementById("messages");
let siteOp = document.getElementById("site");
let usersOp = document.getElementById("users");
let ordersOp = document.getElementById("orders");


productsOp.addEventListener("click",() =>{
sendCategory("products");
});
messagesOp.addEventListener("click",() =>{
sendCategory("messages");
});
siteOp.addEventListener("click",() =>{
sendCategory("site");
});
usersOp.addEventListener("click",() =>{
sendCategory("users");
});
ordersOp.addEventListener("click",() =>{
sendCategory("orders");
});
});

function sendCategory(section){
fetch('categories.php', {
method: 'POST',
headers:{
	'Content-Type': 'application/x-www-form-urlencoded'
},
body: 'section=' + encodeURIComponent(section)

})
.then(res =>res.text())
.then(html =>{
document.getElementById('content').innerHTML = html;
})
}
document.body.addEventListener("click", (event) => {
if (event.target.classList.contains("edit-button")) {
  const itemId = event.target.id;
  const el = document.getElementById('content');  
  const recordDiv = event.target.closest(".record");
  let data = {
  	id: recordDiv.dataset.id,
	name: recordDiv.dataset.name,
	description: recordDiv.dataset.description,
	image: recordDiv.dataset.image,
	price: recordDiv.dataset.price,
	currency: recordDiv.dataset.currency,
	tags: recordDiv.dataset.tags,
	stock: recordDiv.dataset.stock,
	sku: recordDiv.dataset.sku
  }
 if(itemId.startsWith("products_")){
      el.insertAdjacentHTML("afterbegin", `
<br/><br/>
<div id="popupScrollWrapper">
<div id="promptText">
  <h1>Edit</h1>

  <form class="popupContentWords" action="/adminChanges.php" method="POST">
<p>id: '${data.id}'</p>
 <input type="hidden" name="id" value='${data.id}'>
    <input class="emb" type="tel" name="name" placeholder="name" value='${data.name}'><br/><br/>
 <input class="emb" type="tel" name="description" placeholder="description" value='${data.description}'><br/><br/>
 <input class="emb" type="tel" name="image" placeholder="image" value='${data.image}'><br/><br/>
    <input class="emb" type="tel" name="price" placeholder="price" value='${data.price}'><br/><br/>
 <input class="emb" type="tel" name="currency" placeholder="currency"value='${data.currency}'><br/><br/>
 <input class="emb" type="tel" name="tags" placeholder="tags" value='${data.tags}'><br/><br/>
    <input class="emb" type="tel" name="stock" placeholder="stock" value='${data.stock}'><br/><br/>
 <p>sku: '${data.sku}'</p>
<p>visible?</p>
 <select class="emb" type="tel" name="visible">
<option value="yes">Yes</option>
<option value="no">No</option>
</select><br/><br/>
    <button type="button" class="catEditDelete">Delete</button>
    <button type="button" class="catEditCancel">Cancel</button>
    <button class="emsb" class="catEditSubmit" type="submit">Submit</button>
  </form>
</div>
</div>  
`);
}
if (event.target.classList.contains("edit-button")) {
  const itemId = event.target.id;
  const el = document.getElementById('content');  
  const recordDiv = event.target.closest(".record");

  let data = {
    id: recordDiv.dataset.id,
    first_name: recordDiv.dataset.first_name,
    last_name: recordDiv.dataset.last_name,
    file_path: recordDiv.dataset.file_path,
    email: recordDiv.dataset.email,
    phone: recordDiv.dataset.phone,
    services_requested: recordDiv.dataset.services_requested,
    service_count: recordDiv.dataset.service_count,
    meeting_date: recordDiv.dataset.meeting_date,
    meeting_time: recordDiv.dataset.meeting_time,
    design_info: recordDiv.dataset.design_info,
    submitted_at: recordDiv.dataset.submitted_at  
}

  if (itemId.startsWith("messages_")) {
    el.insertAdjacentHTML("afterbegin", `
      <br/><br/>
      <div id="popupScrollWrapper">
      <div id="promptText">
        <h1>Edit</h1>

        <form class="popupContentWords" action="/subscribe_phone.php" method="POST">
<p>id: '${data.id}'</p>
<input class="emb" type="tel" name="first_name" placeholder="first_name" value='${data.first_name}'><br/><br/>
<input class="emb" type="tel" name="last_name" placeholder="last_name" value='${data.last_name}'><br/><br/>
<input class="emb" type="tel" name="file_path" placeholder="file_path" value='${data.file_path}'><br/><br/>
<input class="emb" type="tel" name="email" placeholder="email" value='${data.email}'><br/><br/>
<input class="emb" type="tel" name="phone" placeholder="phone" value='${data.phone}'><br/><br/>
<input class="emb" type="tel" name="services_requested" placeholder="services_requested" value='${data.services_requested}'><br/><br/>
<input class="emb" type="tel" name="service_count" placeholder="service_count" value='${data.service_count}'><br/><br/>
<input class="emb" type="tel" name="meeting_date" placeholder="meeting_date" value='${data.meeting_date}'><br/><br/>
<input class="emb" type="tel" name="meeting_time" placeholder="meeting_time" value='${data.meeting_time}'><br/><br/>
<input class="emb" type="tel" name="design_info" placeholder="design_info" value='${data.design_info}'><br/><br/>
<p>submitted_at: '${data.submitted_at}'</p>
<p>visible?</p>
<select class="emb" type="tel" name="visible">
  <option value="please answer">Please Answer</option>
  <option value="yes">Yes</option>
  <option value="no">No</option>
</select><br/><br/>
<button  type="button" class="catEditCancel">Cancel</button>
<button class="emsb"class="classEditSubmit" type="submit">Submit</button>
        </form>
</div>
      </div>  
    `);
  }
let catEditCancel = document.getElementsByClassName("catEditCancel");
let catEditSubmit = document.getElementsByClassName("catEditSubmit");
let popupScrollWrapper = document.getElementById("popupScrollWrapper");
let catEditDelete = document.getElementsByClassName("catEditDelete");
//logic for buttons on pop up

for(i=0;i<catEditCancel.length;i++){

catEditCancel[i].addEventListener("click", ()=>{
popupScrollWrapper.remove();
});
}

for(i=0;i<catEditDelete.length;i++){
catEditDelete[i].addEventListener("click", ()=>{
alert("Delete");
});
}


}
if (event.target.classList.contains("edit-button")) {
  const itemId = event.target.id;
  const el = document.getElementById('content');  
  const recordDiv = event.target.closest(".record");

  let data = {
    id: recordDiv.dataset.id,
    username: recordDiv.dataset.username,
    password_hash: recordDiv.dataset.password_hash,
    role: recordDiv.dataset.role,
    full_name: recordDiv.dataset.full_name,
    email: recordDiv.dataset.email,
    status: recordDiv.dataset.status,
    created_at: recordDiv.dataset.created_at,
    department: recordDiv.dataset.department,
    permissions: recordDiv.dataset.permissions
  }

  if (itemId.startsWith("users_")) {
    el.insertAdjacentHTML("afterbegin", `
      <br/><br/>
      <div id="popupScrollWrapper">
	<div id="promptText">
        <h1>Edit</h1>

        <form class="popupContentWords" action="/subscribe_phone.php" method="POST">
<p>id: '${data.id}'</p>
<input class="emb" type="tel" name="username" placeholder="username" value='${data.username}'><br/><br/>
<input class="emb" type="tel" name="password_hash" placeholder="password_hash" value='${data.password_hash}'><br/><br/>
<input class="emb" type="tel" name="role" placeholder="role" value='${data.role}'><br/><br/>
<input class="emb" type="tel" name="full_name" placeholder="full_name" value='${data.full_name}'><br/><br/>
<input class="emb" type="tel" name="email" placeholder="email" value='${data.email}'><br/><br/>
<input class="emb" type="tel" name="status" placeholder="status" value='${data.status}'><br/><br/>
<input class="emb" type="tel" name="created_at" placeholder="created_at" value='${data.created_at}'><br/><br/>
<input class="emb" type="tel" name="department" placeholder="department" value='${data.department}'><br/><br/>
<input class="emb"type="tel" name="permissions" placeholder="permissions" value='${data.permissions}'><br/><br/>
<p>visible?</p>
<select class="emb" type="tel" name="visible">
  <option value="please answer">Please Answer</option>
  <option value="yes">Yes</option>
  <option value="no">No</option>
</select><br/><br/>
<button type="button" class="catEditDelete">Delete</button>
<button type="button" class="catEditCancel">Cancel</button>
<button class="emsb"class="catEditSubmit" type="submit">Submit</button>
        </form>
	</div>
      </div>  
    `);
  }
let catEditCancel = document.getElementsByClassName("catEditCancel");
let catEditSubmit = document.getElementsByClassName("catEditSubmit");
let popupScrollWrapper = document.getElementById("popupScrollWrapper");

for(i=0;i<catEditCancel.length;i++){

catEditCancel[i].addEventListener("click", ()=>{
popupScrollWrapper.remove();
});
}
}
if (event.target.classList.contains("edit-button")) {
  const itemId = event.target.id;
  const el = document.getElementById('content');  
  const recordDiv = event.target.closest(".record");

  let data = {
    order_id: recordDiv.dataset.order_id,
    customer_id: recordDiv.dataset.customer_id,
    order_date: recordDiv.dataset.order_date,
    status: recordDiv.dataset.status,
    payment_status: recordDiv.dataset.payment_status,
    payment_method: recordDiv.dataset.payment_method,
    total_amount: recordDiv.dataset.total_amount,
    subtotal_amount: recordDiv.dataset.subtotal_amount,
    tax_amount: recordDiv.dataset.tax_amount,
    shipping_amount: recordDiv.dataset.shipping_amount,
    discount_amount: recordDiv.dataset.discount_amount,
    coupon_code: recordDiv.dataset.coupon_code,
    shipped: recordDiv.dataset.shipped,
    shipping_name: recordDiv.dataset.shipping_name,
    shipping_phone: recordDiv.dataset.shipping_phone,
    shipping_email: recordDiv.dataset.shipping_email,
    shipping_address: recordDiv.dataset.shipping_address,
    shipping_city: recordDiv.dataset.shipping_city,
    shipping_state: recordDiv.dataset.shipping_state,
    shipping_zip: recordDiv.dataset.shipping_zip,
    shipping_country: recordDiv.dataset.shipping_country,
    shipping_method: recordDiv.dataset.shipping_method,
    tracking_number: recordDiv.dataset.tracking_number,
    delivery_date: recordDiv.dataset.delivery_date,
    notes: recordDiv.dataset.notes,
    created_at: recordDiv.dataset.created_at,
    updated_at: recordDiv.dataset.updated_at
  }

  if (itemId.startsWith("orders_")) {
    el.insertAdjacentHTML("afterbegin", `
      <br/><br/>
	<div id="popupScrollWrapper">
      <div id="promptText">
        <h1>Edit</h1>

        <form class="popupContentWords" action="/subscribe_phone.php" method="POST">
<p>order_id: '${data.order_id}'</p>
<input class="emb" type="tel" name="customer_id" placeholder="customer_id" value='${data.customer_id}'><br/><br/>
<input class="emb" type="tel" name="order_date" placeholder="order_date" value='${data.order_date}'><br/><br/>
<input class="emb" type="tel" name="status" placeholder="status" value='${data.status}'><br/><br/>
<input class="emb" type="tel" name="payment_status" placeholder="payment_status" value='${data.payment_status}'><br/><br/>
<input class="emb" type="tel" name="payment_method" placeholder="payment_method" value='${data.payment_method}'><br/><br/>
<input class="emb" type="tel" name="total_amount" placeholder="total_amount" value='${data.total_amount}'><br/><br/>
<input class="emb" type="tel" name="subtotal_amount" placeholder="subtotal_amount" value='${data.subtotal_amount}'><br/><br/>
<input class="emb" type="tel" name="tax_amount" placeholder="tax_amount" value='${data.tax_amount}'><br/><br/>
<input class="emb" type="tel" name="shipping_amount" placeholder="shipping_amount" value='${data.shipping_amount}'><br/><br/>
<input class="emb" type="tel" name="discount_amount" placeholder="discount_amount" value='${data.discount_amount}'><br/><br/>
<input class="emb" type="tel" name="coupon_code" placeholder="coupon_code" value='${data.coupon_code}'><br/><br/>
<input class="emb" type="tel" name="shipped" placeholder="shipped" value='${data.shipped}'><br/><br/>
<input class="emb" type="tel" name="shipping_name" placeholder="shipping_name" value='${data.shipping_name}'><br/><br/>
<input class="emb" type="tel" name="shipping_phone" placeholder="shipping_phone" value='${data.shipping_phone}'><br/><br/>
<input class="emb" type="tel" name="shipping_email" placeholder="shipping_email" value='${data.shipping_email}'><br/><br/>
<input class="emb"type="tel" name="shipping_address" placeholder="shipping_address" value='${data.shipping_address}'><br/><br/>
<input class="emb" type="tel" name="shipping_city" placeholder="shipping_city" value='${data.shipping_city}'><br/><br/>
<input class="emb" type="tel" name="shipping_state" placeholder="shipping_state" value='${data.shipping_state}'><br/><br/>
<input class="emb" type="tel" name="shipping_zip" placeholder="shipping_zip" value='${data.shipping_zip}'><br/><br/>
<input class="emb" type="tel" name="shipping_country" placeholder="shipping_country" value='${data.shipping_country}'><br/><br/>
<input class="emb" type="tel" name="shipping_method" placeholder="shipping_method" value='${data.shipping_method}'><br/><br/>
<input class="emb" type="tel" name="tracking_number" placeholder="tracking_number" value='${data.tracking_number}'><br/><br/>
<input class="emb" type="tel" name="delivery_date" placeholder="delivery_date" value='${data.delivery_date}'><br/><br/>
<input class="emb" type="tel" name="notes" placeholder="notes" value='${data.notes}'><br/><br/>
<p>created_at: '${data.created_at}'</p>
<p>updated_at: '${data.updated_at}'</p>
<p>visible?</p>
<select class="emb" type="tel" name="visible">
  <option value="please answer">Please Answer</option>
  <option value="yes">Yes</option>
  <option value="no">No</option>
</select><br/><br/>
<button type="button" class="catEditCancel">Cancel</button>
<button class="emsb" class="catEditSubmit" type="submit">Submit</button>
        </form>
	</div>
      </div>  
    `);
  }
}
let catEditCancel = document.getElementsByClassName("catEditCancel");
let catEditSubmit = document.getElementsByClassName("catEditSubmit");
let popupScrollWrapper = document.getElementById("popupScrollWrapper");

for(i=0;i<catEditCancel.length;i++){

catEditCancel[i].addEventListener("click", ()=>{
popupScrollWrapper.remove();
});
}
}
});


