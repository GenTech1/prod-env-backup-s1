const tabs = document.querySelectorAll('[data-tab-target]');
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabTarget);
        const tabContents = document.querySelectorAll('[data-tab-content]');
        tabs.forEach(t => {
            t.style.textDecoration = "none";
        })
        tabContents.forEach(content => {
            content.classList.remove('active');
            
        })
        target.classList.add('active')
        tab.style.textDecoration = "underline";
    })
})