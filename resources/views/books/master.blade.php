{{------------------------ Used only in books.single route ------------------}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}" />

   <meta name="robots" content="none"/>
   <meta name="googlebot" content="noindex, nofollow"/>
   <meta name="yandex" content="none"/>
   
   <title>Хирад | {{$book->name}}</title>

   {{-- Roboto font --}}
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
   {{-- Lobster font --}}
   <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
   <!-- FONT AWESOME 5 -->
   <script src="https://kit.fontawesome.com/0f5643e341.js" crossorigin="anonymous"></script>
   {{-- Bootstrap v5.0 --}}
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   {{-- JQueryFormStyler --}}
   <link href="{{ asset('css/jqformstyler/jquery.formstyler.css') }}" rel="stylesheet">
   <link href="{{ asset('css/jqformstyler/jquery.formstyler.theme.css') }}" rel="stylesheet">
   {{-- Select2 --}}
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   <link href="{{ asset('css/main/styles.css') }}" rel="stylesheet">
   <link href="{{ asset('css/main/modal.css') }}" rel="stylesheet">
   
   {{-- JQ Gallery Plugin --}}
   <link href="{{ asset('js/simplelightbox-master/dist/simple-lightbox.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/books_single/styles.css') }}" rel="stylesheet">

</head>
<body>
   
   @include('templates.navbar')
   {{-- SCROLL TOP BUTTON --}}
   <button id="scrollTop"><i class="fa fa-angle-double-up"></i></button>
   @yield('content')
   @include('templates.login-modal')
   @include('templates.register-modal')
   @include('templates.footer')

   {{-- JQery 3.6.0 --}}
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   {{-- Bootstrap v5.0 --}}
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
   {{-- JQueryFormStyler --}}
   <script src=" {{asset('js/JQueryFormStyler/jquery.formstyler.min.js') }}"></script>
   {{-- Select2 --}}
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

   <script src="{{ asset('js/main.js') }}"></script>

   {{-- JQ Gallery Plugin --}}
   <script src="{{ asset('js/simplelightbox-master/dist/simple-lightbox.jquery.min.js') }}"></script>
   {{-- Screenshots disabled for free books --}}
   @if(!$book->isFree)
      <script>  var gallery = $('.gallery a').simpleLightbox({ });  </script>
   @endif

   <script src="{{ asset('js/books_single.js') }}"></script>

</body>
</html>