// Отримуємо всі елементи питань
const faqItems = document.querySelectorAll('.faq-children');

// Додаємо обробник подій для кожного питання
faqItems.forEach(item => {
    item.addEventListener('click', () => {
        // Знаходимо відповідь, пов'язану з питанням
        const answer = item.querySelector('.faq-answer');
        
        // Перемикаємо видимість відповіді при кліку на питання
        answer.classList.toggle('visible');
    });
});
