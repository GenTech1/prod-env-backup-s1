// Button click messages (you can replace with real functions later)

document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', () => {
        console.log(`Button clicked: ${btn.innerText}`);
    });
});

// Example: animate boxes on hover
const boxes = document.querySelectorAll('.box');
boxes.forEach(box => {
    box.addEventListener('mouseenter', () => {
        box.style.transform = "scale(1.03)";
        box.style.transition = "0.2s";
    });
    box.addEventListener('mouseleave', () => {
        box.style.transform = "scale(1)";
    });
});
