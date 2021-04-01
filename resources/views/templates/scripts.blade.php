
@switch($route)

   @case('home')
      <script src="{{ asset('js/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('js/home.js') }}"></script>
   @break
      
   @case('books.single')
      <script src="{{ asset('js/simplelightbox-master/dist/simple-lightbox.jquery.min.js') }}"></script>
      {{-- Screenshots disabled for free books --}}
      @if(!$book->isFree)
         <script>  var gallery = $('.gallery a').simpleLightbox({ });  </script>
      @endif
      <script src="{{ asset('js/books_single.js') }}"></script>
   @break   

   @case('contacts')
      <script src="{{ asset('js/contacts.js') }}"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAneCOkP0fjY3gOXV9DYFTdA59yWXDvNLw&callback=initMap"
      async defer></script>
   @break   

   @case('authors') @case('authors.popular')
      <script src="{{ asset('js/authors.js') }}"></script>
   @break  

@endswitch