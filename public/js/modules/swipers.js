import { register } from 'swiper/element/bundle';
register();

export function reviewsSwiper() {
    const swiper = document.querySelector('.reviews__slider');

    if(swiper) {
        const swiperParams = {
            slidesPerView: 1,
            speed: 750,
            spaceBetween: 35,
            breakpoints: {
                992: {
                    slidesPerView: 2,
                    spaceBetween: 25,
                },
            },
            on: {
              init() {
              },
            },
          };
        
          Object.assign(swiper, swiperParams);
          swiper.initialize();   
    } 
}