  
$('.testimonials-slider').slick({
  dots: true,
  pauseOnHover:false,
  pauseOnFocus:false,
  slidesToShow:1,
  slidesToScroll: 1,
  adaptiveHeight: false,
  autoplay:false,
  // autoplaySpeed: 6000,
  centerMode: false,
  arrows: false,
  centerPadding: '50px',
  infinite: true,
 
});

// $(document).ready(function(){
//   $('.navbar-toggler').on('click', function(){
//     $(".navbar-collapse").toggleClass('show1');
//   });
// });
$(document).ready(function(){
  $('.navbar-toggler').on('click', function(){
  $("#navbarSupportedContent").toggleClass('show');
 });
});




