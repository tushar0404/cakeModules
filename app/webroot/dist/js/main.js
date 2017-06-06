$(window).scroll(function(){
  var sticky = $('.navbar-wrapper'),
      scroll = $(window).scrollTop();

  if (scroll >= 500) 
  {
	sticky.slideDown('fast').addClass('fixed');
	$('#makeit_header').show();
	$('#cloudirec_logo2').css('display','inline-block');
	$('#cloudirec_logo1').hide();
        $('.navbar-nav li a span').css('color','#00a2e8').css('font-weight','bold');
	$('#makethemcolor').hide();
	
  }
  else{
	 sticky.removeClass('fixed');

	$('#cloudirec_logo2').hide()
	$('#cloudirec_logo1').css('display','inline-block');
  $('#makeit_header').hide();$('#makethemcolor').show();$('.navbar-nav li a span').css('color','white');}
});
/*
(function () {
    var previousScroll = 400,
        sticky = $('.navbar-wrapper');

    $(window).scroll(function(){
       var currentScroll = $(this).scrollTop();
       if (currentScroll > previousScroll){
           $(sticky).slideDown('fast').addClass('fixed');
       } else {
          $(sticky).slideUp().removeClass('fixed');
       }
       previousScroll = currentScroll;
    });
}());
*/
$('.navbar-nav li a span').css('color','white').css('font-weight','bold');