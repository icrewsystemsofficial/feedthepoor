@extends('layouts.layouts')
@section('content')
<br><br><br>
<style media="screen">
@import url('https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700,800');
 * {
	 box-sizing: border-box;
}
 
 .blg-slider {
	 width: 95%;
	 position: relative;
	 max-width: 800px;
	 margin: auto;
	 background: #fff;
	 box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.2);
	 padding: 25px;
	 border-radius: 25px;
	 height: 400px;
	 transition: all 0.3s;
}
 @media screen and (max-width: 992px) {
	 .blg-slider {
		 max-width: 680px;
		 height: 400px;
	}
}
 @media screen and (max-width: 768px) {
	 .blg-slider {
		 min-height: 500px;
		 height: auto;
		 margin: 180px auto;
	}
}
 @media screen and (max-height: 500px) and (min-width: 992px) {
	 .blg-slider {
		 height: 350px;
	}
}
 .blg-slider__item {
	 display: flex;
	 align-items: center;
}
 @media screen and (max-width: 768px) {
	 .blg-slider__item {
		 flex-direction: column;
	}
}
 .blg-slider__item.swiper-slide-active .blg-slider__img img {
	 opacity: 1;
	 transition-delay: 0.3s;
}
 .blg-slider__item.swiper-slide-active .blg-slider__content > * {
	 opacity: 1;
	 transform: none;
}
 .blg-slider__img {
	 width: 300px;
	 flex-shrink: 0;
	 height: 300px;
	 background-image: linear-gradient(147deg, #fe8a39 0%, #fd3838 74%);
	 box-shadow: 4px 13px 30px 1px rgba(252, 56, 56, 0.2);
	 border-radius: 20px;
	 transform: translateX(-80px);
	 overflow: hidden;
}
 .blg-slider__img:after {
	 content: '';
	 position: absolute;
	 top: 0;
	 left: 0;
	 width: 100%;
	 height: 100%;
	 background-image: linear-gradient(147deg, #fe8a39 0%, #fd3838 74%);
	 border-radius: 20px;
	 opacity: 0.8;
}
 .blg-slider__img img {
	 width: 100%;
	 height: 100%;
	 object-fit: cover;
	 display: block;
	 opacity: 0;
	 border-radius: 20px;
	 transition: all 0.3s;
}
 @media screen and (max-width: 768px) {
	 .blg-slider__img {
		 transform: translateY(-50%);
		 width: 90%;
	}
}
 @media screen and (max-width: 576px) {
	 .blg-slider__img {
		 width: 95%;
	}
}
 @media screen and (max-height: 500px) and (min-width: 992px) {
	 .blg-slider__img {
		 height: 270px;
	}
}
 .blg-slider__content {
	 padding-right: 25px;
}
 @media screen and (max-width: 768px) {
	 .blg-slider__content {
		 margin-top: -80px;
		 text-align: center;
		 padding: 0 30px;
	}
}
 @media screen and (max-width: 576px) {
	 .blg-slider__content {
		 padding: 0;
	}
}
 .blg-slider__content > * {
	 opacity: 0;
	 transform: translateY(25px);
	 transition: all 0.4s;
}
 .blg-slider__code {
	 color: #7b7992;
	 margin-bottom: 15px;
	 display: block;
	 font-weight: 500;
}
 .blg-slider__title {
	 font-size: 24px;
	 font-weight: 700;
	 color: #0d0925;
	 margin-bottom: 20px;
}
 .blg-slider__text {
	 color: #4e4a67;
	 margin-bottom: 30px;
	 line-height: 1.5em;
}
 .blg-slider__button {
	 display: inline-flex;
	 background-image: linear-gradient(147deg, #fe8a39 0%, #fd3838 74%);
	 padding: 15px 35px;
	 border-radius: 50px;
	 color: #fff;
	 box-shadow: 0px 14px 80px rgba(252, 56, 56, 0.4);
	 text-decoration: none;
	 font-weight: 500;
	 justify-content: center;
	 text-align: center;
	 letter-spacing: 1px;
}
 @media screen and (max-width: 576px) {
	 .blg-slider__button {
		 width: 100%;
	}
}
 .blg-slider .swiper-container-horizontal > .swiper-pagination-bullets, .blg-slider .swiper-pagination-custom, .blg-slider .swiper-pagination-fraction {
	 bottom: 10px;
	 left: 0;
	 width: 100%;
}
 .blg-slider__pagination {
	 position: absolute;
	 z-index: 21;
	 right: 20px;
	 width: 11px !important;
	 text-align: center;
	 left: auto !important;
	 top: 50%;
	 bottom: auto !important;
	 transform: translateY(-50%);
}
 @media screen and (max-width: 768px) {
	 .blg-slider__pagination {
		 transform: translateX(-50%);
		 left: 50% !important;
		 top: 205px;
		 width: 100% !important;
		 display: flex;
		 justify-content: center;
		 align-items: center;
	}
}
 .blg-slider__pagination.swiper-pagination-bullets .swiper-pagination-bullet {
	 margin: 8px 0;
}
 @media screen and (max-width: 768px) {
	 .blg-slider__pagination.swiper-pagination-bullets .swiper-pagination-bullet {
		 margin: 0 5px;
	}
}
 .blg-slider__pagination .swiper-pagination-bullet {
	 width: 11px;
	 height: 11px;
	 display: block;
	 border-radius: 10px;
	 background: #062744;
	 opacity: 0.2;
	 transition: all 0.3s;
}
 .blg-slider__pagination .swiper-pagination-bullet-active {
	 opacity: 1;
	 background: #fd3838;
	 height: 30px;
	 box-shadow: 0px 0px 20px rgba(252, 56, 56, 0.3);
}
 @media screen and (max-width: 768px) {
	 .blg-slider__pagination .swiper-pagination-bullet-active {
		 height: 11px;
		 width: 30px;
	}
}

</style>
<div class="blg-slider">
  <div class="blg-slider__wrp swiper-wrapper">
    <div class="blg-slider__item swiper-slide">
      <div class="blg-slider__img">

        <img src="https://res.cloudinary.com/muhammederdem/image/upload/v1535759872/kuldar-kalvik-799168-unsplash.jpg" alt="">
      </div>
      <div class="blg-slider__content">
        <span class="blg-slider__code">26 December 2019</span>
        <div class="blg-slider__title">Lorem Ipsum Dolor</div>
        <div class="blg-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi? </div>
        <a href="#" class="blg-slider__button">READ MORE</a>
      </div>
    </div>
    <div class="blg-slider__item swiper-slide">
      <div class="blg-slider__img">
        <img src="https://res.cloudinary.com/muhammederdem/image/upload/v1535759871/jason-leung-798979-unsplash.jpg" alt="">
      </div>
      <div class="blg-slider__content">
        <span class="blg-slider__code">26 December 2019</span>
        <div class="blg-slider__title">Lorem Ipsum Dolor2</div>
        <div class="blg-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
        <a href="#" class="blg-slider__button">READ MORE</a>
      </div>
    </div>

    <div class="blg-slider__item swiper-slide">
      <div class="blg-slider__img">
        <img src="https://res.cloudinary.com/muhammederdem/image/upload/v1535759871/alessandro-capuzzi-799180-unsplash.jpg" alt="">
      </div>
      <div class="blg-slider__content">
        <span class="blg-slider__code">26 December 2019</span>
        <div class="blg-slider__title">Lorem Ipsum Dolor</div>
        <div class="blg-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
        <a href="#" class="blg-slider__button">READ MORE</a>
      </div>
    </div>

  </div>
  <div class="blg-slider__pagination"></div>
</div>


<script>
var swiper = new Swiper('.blg-slider', {
      spaceBetween: 30,
      effect: 'fade',
      loop: true,
      mousewheel: {
        invert: false,
      },
      // autoHeight: true,
      pagination: {
        el: '.blg-slider__pagination',
        clickable: true,
      }
    });
</script><br>
@endsection
