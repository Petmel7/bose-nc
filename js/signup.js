
const toggleItems = document.querySelectorAll('.toggle-sign');

toggleItems.forEach(item => {
    item.addEventListener('click', () => {
        const target = item.getAttribute('data-target');
        const formSign = document.querySelector(`.form-sign[data-id="${target}"]`);

        if (formSign) {
            formSign.classList.toggle('visible');
        }
    });
});


