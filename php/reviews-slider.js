
// JavaScript код для взаємодії з Hammer.js та каруселлю
        const slider = document.querySelector('.slider');
        const slides = document.querySelectorAll('.reviews-block');
        const paginationItems = document.querySelectorAll('.pagination-item');

        let activeSlide = 0;

        // Функція для зміни активного слайда
        function setActiveSlide(index) {
            slides[activeSlide].classList.remove('active');
            paginationItems[activeSlide].classList.remove('active');
            slides[index].classList.add('active');
            paginationItems[index].classList.add('active');
            activeSlide = index;
        }

        // Перехід до відповідного слайда при кліку на пагінацію
        paginationItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                setActiveSlide(index);
                slider.scroll({
                    left: slides[index].offsetLeft,
                    behavior: 'smooth'
                });
            });
        });

        // Використання Hammer.js для перемикання слайдів по дотику
        const hammertime = new Hammer(slider);
        hammertime.on('swipeleft', () => {
            if (activeSlide < slides.length - 1) {
                setActiveSlide(activeSlide + 1);
                slider.scroll({
                    left: slides[activeSlide].offsetLeft,
                    behavior: 'smooth'
                });
            }
        });

        hammertime.on('swiperight', () => {
            if (activeSlide > 0) {
                setActiveSlide(activeSlide - 1);
                slider.scroll({
                    left: slides[activeSlide].offsetLeft,
                    behavior: 'smooth'
                });
            }
        });