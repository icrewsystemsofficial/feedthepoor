var swiper = new Swiper('.testimonial-slider', {
      spaceBetween: 30,
      effect: 'fade',
      loop: true,
      mousewheel: {
        invert: false,
      },
      // autoHeight: true,
      pagination: {
        el: '.testimonial-slider__pagination',
        clickable: true,
      }
    });
