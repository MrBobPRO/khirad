
@switch($route)

   @case('home')
      <script src="{{ asset('js/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
      {{-- JQueryFormStyler --}}
      <script src=" {{asset('js/JQueryFormStyler/jquery.formstyler.min.js') }}"></script>
      <script src="{{ asset('js/home.js') }}"></script>
   @break

   @case('authors') @case('authors.popular') @case('authors.by_letter')
      {{-- Select2 --}}
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script src="{{ asset('js/authors.js') }}"></script>
   @break

   @case('contacts')
      <script src="{{ asset('js/contacts.js') }}"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAneCOkP0fjY3gOXV9DYFTdA59yWXDvNLw&callback=initMap"
      async defer></script>
   @break   

@endswitch