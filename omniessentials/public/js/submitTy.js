document.addEventListener("DOMContentLoaded", () => {
    const homeBtn = document.getElementById("goHome");

    homeBtn.addEventListener("click", () => {
        window.location.href = "index.php";
    });
});