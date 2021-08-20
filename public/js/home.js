$('.jq-select').styler();  //JQ FORM STYLER

// OWL CAROUSEL START
$('.owl-carousel').owlCarousel({
   margin:15,
   loop:true,
   autoWidth:true,
   items: 3,
   dots: false
})

// OWL CAROUSEL NAVIGATIONS
var owl = $('.owl-carousel');
owl.owlCarousel();

function nextSlide() {
   owl.trigger('next.owl.carousel');
}

function prevSlide() {
   owl.trigger('prev.owl.carousel');
}
// OWL CAROUSEL END