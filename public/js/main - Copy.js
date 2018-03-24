$('.bxslider').bxSlider({
  auto:  false,
  pause:6000,
  infiniteLoop:  true,
  autoHover:  true,
  easing: 'easeOutElastic',
  speed: 600,
  slideMargin:15,
  minSlides: 2,
  maxSlides: 4,
  moveSlides: 4,
  autoReload:true,
  pager:false,
  breaks: [{screen:0, slides:1.5},{screen:460, slides:2.5},{screen:768, slides:3},{screen:992, slides:4}]
});
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


$(".yt-item").each(function(index) { 
 var playersrc=$('#yt'+index).attr('src');
 $('#yt'+index).mouseover(function(){
  $('#yt'+index).attr('src',playersrc+'&autoplay=1');
 });
 $('#yt'+index).mouseout(function(){
  $('#yt'+index).attr('src',playersrc);
 });
});