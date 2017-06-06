$(window).scroll(function(){
  var sticky = $('.navbar-wrapper'),
      scroll = $(window).scrollTop();

  if (scroll >= 500) 
  {
	sticky.slideDown('fast').addClass('fixed');
	$('#makeit_header').show();
	$('#makethemcolor li a span').css('color','#2e6da4');
	
  }
  else{
	 sticky.removeClass('fixed');
  $('#makeit_header').hide();$('#makethemcolor li a span').css('color','inherit');}
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
$(window).scroll(function(){
  var sticky = $('#contact_us_page'),
      scroll = $(window).scrollTop();

  if (scroll >=100) sticky.slideDown('fast').addClass('fixed');
  else sticky.removeClass('fixed');
});

