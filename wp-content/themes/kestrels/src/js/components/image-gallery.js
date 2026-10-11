import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.image-gallery__swiper').forEach(el => {
        new Swiper(el, {
            modules: [Navigation, Pagination],
            slidesPerView: 1,
            loop: true,
            navigation: {
                prevEl: el.querySelector('.swiper-button-prev'),
                nextEl: el.querySelector('.swiper-button-next'),
            },
            pagination: {
                el: el.querySelector('.swiper-pagination'),
                clickable: true,
            },
        });
    });

});
