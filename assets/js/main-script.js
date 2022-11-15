let burgerMenu = document.querySelector(".burger-menu");
let navigationMenu = document.querySelector(".navigation-menu");

burgerMenu.addEventListener("click", ()=>{
    burgerMenu.classList.toggle("active");
    navigationMenu.classList.toggle("menu-active");
})