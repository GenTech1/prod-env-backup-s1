let first = document.getElementsByName("first_name")[0];
let last = document.getElementsByName("last_name")[0];
let email = document.getElementsByName("email")[0];

let message = document.getElementsByName("message")[0];
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
   }else if(message.value.trim().length < 10 || message.value.trim().length > 1000){
        event.preventDefault();
        alert("Please enter a message between 10 and 1000 characters.");
   }
}); 