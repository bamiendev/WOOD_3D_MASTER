const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");

const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");


inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});

toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});

let index = 1;
function moveSlider() {
  let currentImage = document.querySelector(`.img-${index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.3}rem)`;

  bullets.forEach((bull) => bull.classList.remove("active"));
  bullets[index - 1].classList.add("active");
}

// Tự động thay đổi carousel mỗi 2 giây
setInterval(function () {
  index++;
  if (index > bullets.length) {
    index = 1;
  }
  moveSlider();
}, 2000);

bullets.forEach((bullet, i) => {
  bullet.addEventListener("click", function () {
    index = i + 1;
    moveSlider();
  });
});



// document.addEventListener('keydown', function (event) {
//   if (event.keyCode === 123) {
//     event.preventDefault();
//   }
// }, false);

// document.addEventListener('contextmenu', function (event) {
//   event.preventDefault();
// }, false);
