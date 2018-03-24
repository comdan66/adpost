$('.slider-prev').click(function () {
  var current = $slider.getCurrentSlide();
  $slider.goToPrevSlide(current) - 1;
});
$('.slider-next').click(function () {
  var current = $slider.getCurrentSlide();
  $slider.goToNextSlide(current) + 1;
});

// Configure the slider every time its size changes.
$(window).on("orientationchange resize", configureSlider);
// Configure the slider once on page load.
configureSlider();

var slider = $('.bxslider-single').bxSlider({
    pagerCustom: '#bx-pager',
});
/* load */
    $(".guest-response li").slice(0, 4).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".guest-response li:hidden").slice(0, 4).slideDown();
        if ($(".guest-response li:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
});
/*management*/
$(".adver-item .details").bind('click',function(){
    if($(this).prev('.content').is(":hidden")){  
        $(this).prev('.content').slideToggle();  
        $(this).find(".view_details").text("收合詳細資訊");  
        $(this).find(".fa").removeClass("fa-angle-down").addClass("fa-angle-up");  
        }  
    else{  
        $(this).prev('.content').slideUp();  
        $(this).find(".view_details").text("展開詳細資訊");  
        $(this).find(".fa").removeClass("fa-angle-up").addClass("fa-angle-down");  
        }  
 });

var len = 20; // 超過20個字以"..."取代
    $(".JQellipsis").each(function(i){
        if($(this).text().length>len){
            $(this).attr("title",$(this).text());
            var text=$(this).text().substring(0,len-1)+"...";
            $(this).text(text);
        }
});
$(".yt-item").each(function(index) { 
 var playersrc=$('#yt'+index).attr('src');
 $('#yt'+index).mouseover(function(){
  $('#yt'+index).attr('src',playersrc+'&autoplay=1');
 });
 $('#yt'+index).mouseout(function(){
  $('#yt'+index).attr('src',playersrc);
 });
});

// Use the conventional $ prefix for variables that hold jQuery objects.
var $slider;

// If the only purpose of the windowWidth() function is to set the slide variables,
// it can be renamed and rewritten to supply the full configuration object instead.
function buildSliderConfiguration() {
  // When possible, you should cache calls to jQuery functions to improve performance.
  var windowWidth = $(window).width();
  var numberOfVisibleSlides;

  if (windowWidth < 480) {
    numberOfVisibleSlides = 1.5;
  }
  else if (windowWidth < 768) {
    numberOfVisibleSlides = 2;
  }
  else if (windowWidth < 1200) {
    numberOfVisibleSlides = 3;
  }
  else {
    numberOfVisibleSlides = 4;
  }

  return {
    pager: false,
    controls: true,
    auto: false,
    slideWidth: 5000,
    startSlide: 0,
    nextText: ' ',
    prevText: ' ',
    adaptiveHeight: false,
    moveSlides: 4,
    slideMargin: 15,
    minSlides: numberOfVisibleSlides,
    maxSlides: numberOfVisibleSlides
  };
}
// This function can be called either to initialize the slider for the first time
// or to reload the slider when its size changes.
function configureSlider() {
  var config = buildSliderConfiguration();

  if ($slider && $slider.reloadSlider) {
    // If the slider has already been initialized, reload it.
    $slider.reloadSlider(config);
  }
  else {
    // Otherwise, initialize the slider.
    $slider = $('.bxslider').bxSlider(config);
  }
}

$('.slider-prev').click(function () {
  var current = $slider.getCurrentSlide();
  $slider.goToPrevSlide(current) - 1;
});
$('.slider-next').click(function () {
  var current = $slider.getCurrentSlide();
  $slider.goToNextSlide(current) + 1;
});

// Configure the slider every time its size changes.
$(window).on("orientationchange resize", configureSlider);
// Configure the slider once on page load.
configureSlider();