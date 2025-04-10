if (jQuery(".format-accordion").length) {
  jQuery(".format-accordion").accordion({
    questionClass: '.question',
    answerClass: '.content',
    itemClass: '.column-item'
  });
}


if (jQuery(".format-accordion2").length) {
  jQuery(".format-accordion2").accordion({
    questionClass: '.question2',
    answerClass: '.content2',
    itemClass: '.column-item2'
  });
}














$(document).ready(function () {
  //Horizontal Tab
  $('#products').easyResponsiveTabs({
    type: 'default', //Types: default, vertical, accordion
    width: 'auto', //auto or any width like 600px
    fit: true, // 100% fit in a container
    tabidentify: 'hor_1', // The tab groups identifier
    activate: function (event) { // Callback function if tab is switched
      var $tab = $(this);
      var $info = $('#nested-tabInfo');
      var $name = $('span', $info);
      $name.text($tab.text());
      $info.show();
    }
  });
});
$(document).ready(function () {
  //Horizontal Tab
  $('#programmes').easyResponsiveTabs({
    type: 'default', //Types: default, vertical, accordion
    width: 'auto', //auto or any width like 600px
    fit: true, // 100% fit in a container
    tabidentify: 'hor_1', // The tab groups identifier
    activate: function (event) { // Callback function if tab is switched
      var $tab = $(this);
      var $info = $('#nested-tabInfo');
      var $name = $('span', $info);
      $name.text($tab.text());
      $info.show();
    }
  });
});
$(".nri.btn-right-arrow").click(function () {
  $(this).addClass("arrow-down active");
  $(".nri-text").fadeIn();
  $(".pio-text,.sea-text,.foreign-text").hide();
  $(".pio.btn-right-arrow,.sea.btn-right-arrow,.foreign.btn-right-arrow ").removeClass("arrow-down active");
  $(".footer").addClass("position-static");
  $(".particles-bg").hide();
  $(".footer-fixed-page").addClass("footer-fixed-page2");
});
$(".pio.btn-right-arrow").click(function () {
  $(this).addClass("arrow-down active");
  $(".pio-text").fadeIn();
  $(".nri-text,.sea-text,.foreign-text").hide();
  $(".nri.btn-right-arrow,.sea.btn-right-arrow,.foreign.btn-right-arrow").removeClass("arrow-down active");
  $(".footer").addClass("position-static");
  $(".particles-bg").hide();
  $(".footer-fixed-page").addClass("footer-fixed-page2");
});
$(".sea.btn-right-arrow").click(function () {
  $(this).addClass("arrow-down active");
  $(".sea-text").fadeIn();
  $(".nri-text,.pio-text,.foreign-text").hide();
  $(".nri.btn-right-arrow,.pio.btn-right-arrow,.foreign.btn-right-arrow").removeClass("arrow-down active");
  $(".footer").addClass("position-static");
  $(".particles-bg").hide();
  $(".footer-fixed-page").addClass("footer-fixed-page2");
});
$(".foreign.btn-right-arrow").click(function () {
  $(this).addClass("arrow-down active");
  $(".foreign-text").fadeIn();
  $(".nri-text,.pio-text,.sea-text").hide();
  $(".nri.btn-right-arrow,.pio.btn-right-arrow,.sea.btn-right-arrow").removeClass("arrow-down active");
  $(".footer").addClass("position-static");
  $(".particles-bg").hide();
  $(".footer-fixed-page").addClass("footer-fixed-page2");
});
$(".products-middle").click(function () {
  $(".footer").addClass("position-static");
  $(".particles-bg").hide();
  $(".footer-fixed-page").addClass("footer-fixed-page2");
});







// $(".goBack").click(function () {
//   $(".footer").removeClass("position-static");
 


// });



// $(".question1").click(function(){
//   window.open("#question1","_self");
//   })


// $(".question2").click(function(){
//   window.open("#question2","_self");
//   })




// $(".question3").click(function(){
//   window.open("#question3","_self");
//   })


// $(".question4").click(function(){
//   window.open("#question4","_self");
//   })

    
// $(".question5").click(function(){
//   window.open("#question5","_self");
//   })




//   $(document).ready(function () {
//     // Handler for .ready() called.
//     $(".question5").animate({
//         scrollTop: $('#question5').offset().top
//     }, 'slow');
// });

$(".dropdown-year").click(function () {
  $(".years-box").slideToggle();
});
$('a[href*="#"]').on('click', function (e) {
  e.preventDefault()
  $('html, body').animate({
      scrollTop: $($(this).attr('href')).offset().top - 0,
    },
    500,
    'linear'
  )
})
$(".programmes #box1").click(function () {
  $(this).addClass("active");
  $("#box2,#box3,#box4").removeClass("active");
  $(".programmes #box1 .text-box").fadeIn();
  $(".programmes #box2 .text-box").hide();
  $(".programmes #box3 .text-box").hide();
  $(".programmes #box4 .text-box").hide();
});
$(".programmes #box2").click(function () {
  $(this).addClass("active");
  $("#box1,#box3,#box4").removeClass("active");
  $(".programmes #box1 .text-box").hide();
  $(".programmes #box2 .text-box").fadeIn();
  $(".programmes #box3 .text-box").hide();
  $(".programmes #box4 .text-box").hide();
});
$(".programmes #box3").click(function () {
  $(this).addClass("active");
  $("#box1,#box2,#box4").removeClass("active");
  $(".programmes #box1 .text-box").hide();
  $(".programmes #box2 .text-box").hide();
  $(".programmes #box3 .text-box").fadeIn();
  $(".programmes #box4 .text-box").hide();
});
$(".programmes #box4").click(function () {
  $(this).addClass("active");
  $("#box1,#box2,#box3").removeClass("active");
  $(".programmes #box1 .text-box").hide();
  $(".programmes #box2 .text-box").hide();
  $(".programmes #box3 .text-box").hide();
  $(".programmes #box4 .text-box").fadeIn();
});


$(".thumbnails .thumb1").click(function () {
  $(this).addClass("active");
  $(".big1").fadeIn();
  $(".big2,.big3,.big4,.big5,.big6,.big7,.big8,.big9,.big10").hide();
  $(".thumbnails .thumb2").removeClass("active");
  $(".thumbnails .thumb3").removeClass("active");
  $(".thumbnails .thumb4").removeClass("active");
  $(".thumbnails .thumb5").removeClass("active");
  $(".thumbnails .thumb6").removeClass("active");
  $(".thumbnails .thumb7").removeClass("active");
  $(".thumbnails .thumb8").removeClass("active");
  $(".thumbnails .thumb9").removeClass("active");
  $(".thumbnails .thumb10").removeClass("active");
 
});


$(".thumbnails .thumb2").click(function () {
  $(this).addClass("active");
  $(".big2").fadeIn();
  $(".big1,.big3,.big4,.big5,.big6,.big7,.big8,.big9,.big10").hide();
  $(".thumbnails .thumb1").removeClass("active");
  $(".thumbnails .thumb3").removeClass("active");
  $(".thumbnails .thumb4").removeClass("active");
  $(".thumbnails .thumb5").removeClass("active");
  $(".thumbnails .thumb6").removeClass("active");
  $(".thumbnails .thumb7").removeClass("active");
  $(".thumbnails .thumb8").removeClass("active");
  $(".thumbnails .thumb9").removeClass("active");
  $(".thumbnails .thumb10").removeClass("active");
});

$(".thumbnails .thumb3").click(function () {
  $(this).addClass("active");
  $(".big3").fadeIn();
  $(".big1,.big2,.big4,.big5,.big6,.big7,.big8,.big9,.big10").hide();
  $(".thumbnails .thumb1").removeClass("active");
  $(".thumbnails .thumb2").removeClass("active");
  $(".thumbnails .thumb4").removeClass("active");
  $(".thumbnails .thumb5").removeClass("active");
  $(".thumbnails .thumb6").removeClass("active");
  $(".thumbnails .thumb7").removeClass("active");
  $(".thumbnails .thumb8").removeClass("active");
  $(".thumbnails .thumb9").removeClass("active");
  $(".thumbnails .thumb10").removeClass("active");
});

$(".thumbnails .thumb4").click(function () {
  $(this).addClass("active");
  $(".big4").fadeIn();
  $(".big1,.big2,.big3,.big5,.big6,.big7,.big8,.big9,.big10").hide();
  $(".thumbnails .thumb1").removeClass("active");
  $(".thumbnails .thumb2").removeClass("active");
  $(".thumbnails .thumb3").removeClass("active");
  $(".thumbnails .thumb5").removeClass("active");
  $(".thumbnails .thumb6").removeClass("active");
  $(".thumbnails .thumb7").removeClass("active");
  $(".thumbnails .thumb8").removeClass("active");
  $(".thumbnails .thumb9").removeClass("active");
  $(".thumbnails .thumb10").removeClass("active");
});


$(".thumbnails .thumb5").click(function () {
  $(this).addClass("active");
  $(".big5").fadeIn();
  $(".big1,.big2,.big3,.big4,.big6,.big7,.big8,.big9,.big10").hide();
  $(".thumbnails .thumb1").removeClass("active");
  $(".thumbnails .thumb2").removeClass("active");
  $(".thumbnails .thumb3").removeClass("active");
  $(".thumbnails .thumb4").removeClass("active");
  $(".thumbnails .thumb6").removeClass("active");
  $(".thumbnails .thumb7").removeClass("active");
  $(".thumbnails .thumb8").removeClass("active");
  $(".thumbnails .thumb9").removeClass("active");
  $(".thumbnails .thumb10").removeClass("active");
});

$(".thumbnails .thumb6").click(function () {
  $(this).addClass("active");
  $(".big6").fadeIn();
  $(".big1,.big2,.big3,.big4,.big5,.big7,.big8,.big9,.big10").hide();
  $(".thumbnails .thumb1").removeClass("active");
  $(".thumbnails .thumb2").removeClass("active");
  $(".thumbnails .thumb3").removeClass("active");
  $(".thumbnails .thumb4").removeClass("active");
  $(".thumbnails .thumb5").removeClass("active");
  $(".thumbnails .thumb7").removeClass("active");
  $(".thumbnails .thumb8").removeClass("active");
  $(".thumbnails .thumb9").removeClass("active");
  $(".thumbnails .thumb10").removeClass("active");
});

$(".thumbnails .thumb7").click(function () {
  $(this).addClass("active");
  $(".big7").fadeIn();
  $(".big1,.big2,.big3,.big4,.big5,.big6,.big8,.big9,.big10").hide();
  $(".thumbnails .thumb1").removeClass("active");
  $(".thumbnails .thumb2").removeClass("active");
  $(".thumbnails .thumb3").removeClass("active");
  $(".thumbnails .thumb4").removeClass("active");
  $(".thumbnails .thumb5").removeClass("active");
  $(".thumbnails .thumb6").removeClass("active");
  $(".thumbnails .thumb8").removeClass("active");
  $(".thumbnails .thumb9").removeClass("active");
  $(".thumbnails .thumb10").removeClass("active");
});

$(".thumbnails .thumb8").click(function () {
  $(this).addClass("active");
  $(".big8").fadeIn();
  $(".big1,.big2,.big3,.big4,.big5,.big6,.big7,.big9,.big10").hide();
  $(".thumbnails .thumb1").removeClass("active");
  $(".thumbnails .thumb2").removeClass("active");
  $(".thumbnails .thumb3").removeClass("active");
  $(".thumbnails .thumb4").removeClass("active");
  $(".thumbnails .thumb5").removeClass("active");
  $(".thumbnails .thumb6").removeClass("active");
  $(".thumbnails .thumb7").removeClass("active");
  $(".thumbnails .thumb9").removeClass("active");
  $(".thumbnails .thumb10").removeClass("active");
});

$(".thumbnails .thumb9").click(function () {
  $(this).addClass("active");
  $(".big9").fadeIn();
  $(".big1,.big2,.big3,.big4,.big5,.big6,.big7,.big8,.big10").hide();
  $(".thumbnails .thumb1").removeClass("active");
  $(".thumbnails .thumb2").removeClass("active");
  $(".thumbnails .thumb3").removeClass("active");
  $(".thumbnails .thumb4").removeClass("active");
  $(".thumbnails .thumb5").removeClass("active");
  $(".thumbnails .thumb6").removeClass("active");
  $(".thumbnails .thumb7").removeClass("active");
  $(".thumbnails .thumb8").removeClass("active");
  $(".thumbnails .thumb10").removeClass("active");
});

$(".thumbnails .thumb10").click(function () {
  $(this).addClass("active");
  $(".big10").fadeIn();
  $(".big1,.big2,.big3,.big4,.big5,.big6,.big7,.big8,.big9").hide();
  $(".thumbnails .thumb1").removeClass("active");
  $(".thumbnails .thumb2").removeClass("active");
  $(".thumbnails .thumb3").removeClass("active");
  $(".thumbnails .thumb4").removeClass("active");
  $(".thumbnails .thumb5").removeClass("active");
  $(".thumbnails .thumb6").removeClass("active");
  $(".thumbnails .thumb7").removeClass("active");
  $(".thumbnails .thumb8").removeClass("active");
  $(".thumbnails .thumb9").removeClass("active");
});


 

$(".may-2021").click(function () {
  $("#june-2021-open").hide();
  $("#may-2021-open").fadeIn();
  $(".years-box").slideToggle();
 
  
});

$(".june-2021").click(function () {
  $("#may-2021-open").hide();
  $("#june-2021-open").fadeIn();
  $(".years-box").slideToggle();
});


function goBack() {
  window.history.back();
}

$('.home-slider').slick({
  dots: false,
  infinite: true,
  speed: 500,
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  arrows: true,
  pauseOnHover: false,
  pauseOnFocus: false,
});
