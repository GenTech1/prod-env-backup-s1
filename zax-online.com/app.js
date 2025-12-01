const navItems = document.querySelector(".nav-items")

document.addEventListener('DOMContentLoaded', function () {
  var navIcons = document.querySelectorAll('#nav-icon1');

  navIcons.forEach(function (navIcon) {
    navIcon.addEventListener('click', function () {
      this.classList.toggle('open');
      navItems.classList.toggle("active-nav")
    });
  });


});
