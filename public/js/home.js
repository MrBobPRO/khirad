
// OWL CAROUSEL START
$('.owl-carousel').owlCarousel({
   margin:30,
   loop:true,
   autoWidth:true,
   items: 4,
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