@switch($route)

    @case('home')
      <link href="{{ asset('js/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('js/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet">
      {{-- JQueryFormStyler --}}
      <link href="{{ asset('css/jqformstyler/jquery.formstyler.css') }}" rel="stylesheet">
      <link href="{{ asset('css/jqformstyler/jquery.formstyler.theme.css') }}" rel="stylesheet">
      
      <link href="{{ asset('css/home/styles.css') }}" rel="stylesheet">
    @break

    {{-- SEARCH STYLES ARE ALMOST SAME AS CAT.SING CAT.POP CAT.FREE ETC --}}
    @case('books.search')
      <link href="{{ asset('css/books_search/styles.css') }}" rel="stylesheet">
    @break

    @case('authors') @case('authors.popular') @case('authors.by_letter')
       {{-- Select2 --}}
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <link href="{{ asset('css/authors/styles.css') }}" rel="stylesheet">
    @break

    @case('questions')
      <link href="{{ asset('css/questions/styles.css') }}" rel="stylesheet">
    @break

    @case('contacts')
      <link href="{{ asset('css/contacts/styles.css') }}" rel="stylesheet">
    @break

@endswitch