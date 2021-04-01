
<link href="{{ asset('css/main/styles.css') }}" rel="stylesheet">
<link href="{{ asset('css/main/modal.css') }}" rel="stylesheet">

@switch($route)

    @case('home')
      <link href="{{ asset('js/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('js/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/home/styles.css') }}" rel="stylesheet">
    @break

    @case('books.single')
      <link href="{{ asset('js/simplelightbox-master/dist/simple-lightbox.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/books_single/styles.css') }}" rel="stylesheet">
    @break

    @case('categories.single') @case('categories.popular') @case('categories.discounts') @case('categories.rating') @case('categories.bestsellers') @case('books.all') @case('categories.free')
      <link href="{{ asset('css/categories/styles.css') }}" rel="stylesheet">
    @break
    {{-- SEARCH STYLES ARE ALMOST SAME AS CAT.SING CAT.POP ETC --}}
    @case('books.search')
      <link href="{{ asset('css/books_search/styles.css') }}" rel="stylesheet">
    @break

    @case('authors') @case('authors.popular')
      <link href="{{ asset('css/authors/styles.css') }}" rel="stylesheet">
    @break

    @case('authors.single')
      <link href="{{ asset('css/authors_single/styles.css') }}" rel="stylesheet">
    @break

    @case('archive')
      <link href="{{ asset('css/archive/styles.css') }}" rel="stylesheet">
    @break

    @case('questions')
      <link href="{{ asset('css/questions/styles.css') }}" rel="stylesheet">
    @break

    @case('contacts')
      <link href="{{ asset('css/contacts/styles.css') }}" rel="stylesheet">
    @break

    @case('basket')
      <link href="{{ asset('css/basket/styles.css') }}" rel="stylesheet">
    @break
        
@endswitch