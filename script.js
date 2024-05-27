function setPage(page){
    const log = document.getElementById("connecttoaccount")
    const sign = document.getElementById("openaccount")
    const main = document.getElementById("main")
    const navhome = document.getElementById("nav-home")
    const banker = document.getElementById("banker")
    if (page == "log"){
      log.style.display = ""
      sign.style.display = "none"
      main.style.display = "none"
      banker.style.display = "none"
      navhome.style.display = ""
    }
    else if (page == "sign"){
        log.style.display = "none"
      sign.style.display = ""
      main.style.display = "none"  
      banker.style.display = "none"
      navhome.style.display = ""
    }
    else if (page == "main"){
        log.style.display = "none"
      sign.style.display = "none"
      banker.style.display = "none"
      main.style.display = ""
      navhome.style.display = "none"
    }
    else if (page == "cgv"){
        log.style.display = "none"
      sign.style.display = "none"
      banker.style.display = "none"
      main.style.display = ""
      navhome.style.display = "none"
    }
    else if (page == "banker"){
        log.style.display = "none"
      sign.style.display = "none"
      main.style.display = "none"
      banker.style.display = ""
      navhome.style.display = ""
    }
    else{
        log.style.display = "none"
      sign.style.display = "none"
      banker.style.display = "none"
      main.style.display = ""
      navhome.style.display = "none"  
    }
}
function closent(page){
  const ealert = document.getElementById("ealert");
  const salert = document.getElementById("salert");
  if (page == "ealert"){ealert.style.display = 'none';}
  if (page == "salert"){salert.style.display = 'none';}
}
(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict
$(document).ready(function(){

	$('[data-bss-chart]').each(function(index, elem) {
		this.chart = new Chart($(elem), $(elem).data('bss-chart'));
	});

});