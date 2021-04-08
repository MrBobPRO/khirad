
@switch($route)

   @case('home')
      <script src="{{ asset('js/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('js/home.js') }}"></script>
   @break

   @case('contacts')
      <script src="{{ asset('js/contacts.js') }}"></script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAneCOkP0fjY3gOXV9DYFTdA59yWXDvNLw&callback=initMap"
      async defer></script>
   @break   

@endswitch