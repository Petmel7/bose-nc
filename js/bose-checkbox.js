const checkboxNC = document.getElementById('checkbox-nc');
const checkboxWhite = document.getElementById('checkbox-white');
const imgNC = document.querySelector('.bose-nc--img');
const imgWhite = document.querySelector('.bose-white--img');

checkboxNC.addEventListener('change', function () {
    if (checkboxNC.checked) {
        imgNC.style.display = 'block';
        imgWhite.style.display = 'none';
        checkboxWhite.checked = false;
    }
});

checkboxWhite.addEventListener('change', function () {
    if (checkboxWhite.checked) {
        imgWhite.style.display = 'block';
        imgNC.style.display = 'none';
        checkboxNC.checked = false;
    }
});