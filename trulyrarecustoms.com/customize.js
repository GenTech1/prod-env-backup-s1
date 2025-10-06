let first = document.getElementsByName("first_name")[0];
let last = document.getElementsByName("last_name")[0];
let email = document.getElementsByName("email")[0];
let phone = document.getElementsByName("phone")[0];
let services = document.getElementsByName("services")[0];
let items = document.getElementsByName("items")[0];
let deadline = document.getElementsByName("deadline")[0];
let consultation_time = document.getElementsByName("consultation_time")[0];
let details = document.getElementsByName("details")[0];
let submit = document.getElementsByName("submit")[0];

submit.addEventListener("click", function(event) {
    let phone = document.getElementsByName("phone")[0].value.trim();
    let digits = phone.replace(/\D/g, "");
   if (digits.length !== 10) {
        event.preventDefault();
        alert("Please enter a valid 10-digit phone number.");
   }else if(first.value.trim().length < 3 || first.value.trim().length > 50 || !/^[a-zA-Z]+$/.test(first.value.trim())){
        event.preventDefault();
        alert("Please enter a valid first name (3-50 alphabetic characters).");
   }else if(last.value.trim().length < 3 || last.value.trim().length > 50 || !/^[a-zA-Z]+$/.test(last.value.trim())){
        event.preventDefault();
        alert("Please enter a valid last name (3-50 alphabetic characters).");
   }else if(services.value.trim().length < 3 || services.value.trim().length > 1000){
        event.preventDefault();
        alert("Please enter a service between 3 and 1000 characters.");
   }else if(items.value.trim().length < 1 || items.value.trim().length > 6 || !/^\d+$/.test(items.value.trim()) || parseInt(items.value.trim()) < 1 || parseInt(items.value.trim()) > 999999){
        event.preventDefault();
        alert("The number of items must be between 1 and 999,999.(no commas)");
   }else if(details.value.trim().length < 10 || details.value.trim().length > 1000){
        event.preventDefault();
        alert("Please enter a detail message between 10 and 1000 characters.");
   }else{
let promptText = document.getElementById("popupPay");
  let scroller = document.getElementById("popupScrollWrapper");
  promptText.style.display="block"
  scroller.style.display="block"

  }
}); 