// Вибираємо кнопку "ORDER" та модальне вікно
const openModalBtn = document.getElementById('openModal');
const modal = document.getElementById('myModal');
const closeModal = document.querySelector('.close');

function openModal() {
    var modal = document.getElementById('myModal');
    modal.style.display = 'block';
}

// При кліку на хрестик чи поза модальним вікном - закриваємо його
closeModal.addEventListener('click', function () {
  modal.style.display = 'none';
});

// Закриття модального вікна при кліку поза ним (опційно)
window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};
