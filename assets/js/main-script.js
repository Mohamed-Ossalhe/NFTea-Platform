// nav menu
let header = document.querySelector("header");
let burgerMenu = document.querySelector(".burger-menu");
let navigationMenu = document.querySelector(".navigation-menu");

burgerMenu.addEventListener("click", ()=>{
    burgerMenu.classList.toggle("active");
    navigationMenu.classList.toggle("menu-active");
});

window.addEventListener("scroll", ()=>{
    if(document.documentElement.scrollTop > 50) {
        header.classList.add("header-active");
    }else {
        header.classList.remove("header-active");
    }
});

// question scrumble
let questions = document.querySelectorAll(".question");

for(let i = 0; i < questions.length; i++) {
    questions[i].addEventListener('click', ()=>{
        questions[i].classList.toggle("question-active");
        let panel = questions[i].lastElementChild;
        let questionIcon = questions[i].firstElementChild.lastElementChild;
        if (panel.style.display === "block") {
            questionIcon.classList.replace("bxs-minus-circle", "bxs-plus-circle");
            panel.style.display = "none";
        } else {
            questionIcon.classList.replace("bxs-plus-circle", "bxs-minus-circle");
            panel.style.display = "block";
        }
    });
}

// hero video btn
let videoBtn = document.querySelector(".play-btn");
let video = document.querySelector(".video");

function revealVideo() {
    videoBtn.addEventListener("click", ()=>{
        video.classList.add("video-active");
    });
    video.addEventListener("click", ()=>{
        video.classList.remove("video-active");
        video.firstElementChild.currentTime = 0;
    });
}
revealVideo();