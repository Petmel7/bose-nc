// function toggleMenu() {
//     let menu = document.querySelector('.menu');
//     menu.classList.toggle('active');
// }

// function toggleMenu() {
//     let menu = document.querySelector('.menu');
//     menu.classList.toggle('active');

//     let burgerIcon = document.querySelector('.pinpong');
//     let closeIcon = document.querySelector('.pinpong2');

//     // Перевірка, чи меню відкрите
//     if (menu.classList.contains('active')) {
//         burgerIcon.style.display = 'none'; // Ховаємо іконку бургера
//         closeIcon.style.display = 'block'; // Показуємо іконку закриття
//     } else {
//         burgerIcon.style.display = 'block'; // Показуємо іконку бургера
//         closeIcon.style.display = 'none'; // Ховаємо іконку закриття
//     }
// }



let strokesArr = document.querySelectorAll('.stroke');

document.querySelector('.hamburger-icon').addEventListener('click', function() {
  strokesArr.forEach(function(el) {
    console.log(el.classList);
  el.classList.toggle('active');
});
});