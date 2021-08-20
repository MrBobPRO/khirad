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
   <meta name="keywords" content="{{$book->name}}, книги, бесплатные книги, онлайн библиотека, купить книги в Таджикистане, читать книги онлайн"/>

   {{-- Opengraph --}}
   <meta name="description" content="{{$shareText}}">
   <meta property="og:description" content="{{$shareText}}">
   <meta property="og:locale" content="ru_RU" />
   <meta property="og:type" content="object" />
   <meta property="og:title" content="{{$book->name}}" />
   <meta property="og:site_name" content="Хирад" />
   <meta property="og:image" content="{{asset('img/books/' . $book->photo)}}">
   <meta name="twitter:card" content="summary_large_image">
   <meta name="twitter:title" content="{{$book->name}}">
   <meta name="twitter:image" content="{{asset('img/books/' . $book->photo)}}">
 
   <link rel="icon" href="{{ asset('img/main/cropped-favi-32x32.png') }}" sizes="32x32">
   <link rel="icon" href="{{ asset('img/main/cropped-favi-192x192.png') }}" sizes="192x192">
   <link rel="apple-touch-icon-precomposed" href="{{ asset('img/main/cropped-favi-180x180.png') }}">
   <meta name="msapplication-TileImage" content="{{ asset('img/main/cropped-favi-270x270.png') }}">

   {{-- Roboto font --}}
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
   {{-- Cuprum font --}}
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Cuprum:ital,wght@1,700&display=swap" rel="stylesheet">
   <!-- FONT AWESOME 5 -->
   <script src="https://kit.fontawesome.com/0f5643e341.js" crossorigin="anonymous"></script>
   {{-- Bootstrap v5.0 --}}
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

   <link href="{{ asset('css/main/styles.css') }}" rel="stylesheet">
   
   {{-- JQ Gallery Plugin --}}
   <link href="{{ asset('js/simplelightbox-master/dist/simple-lightbox.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/books_single/styles.css') }}" rel="stylesheet">

</head>
<body>
   
   @include('templates.header')
   {{-- SCROLL TOP BUTTON --}}
   <button id="scrollTop"><i class="fa fa-angle-double-up"></i></button>
   @yield('content')
   @include('templates.footer')

   {{-- JQery 3.6.0 --}}
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   {{-- Bootstrap v5.0 --}}
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
   {{-- Yandex share buttons --}}
   <script src="https://yastatic.net/share2/share.js" async="async"></script>

   <script src="{{ asset('js/main.js') }}"></script>

   {{-- JQ Gallery Plugin --}}
   <script src="{{ asset('js/simplelightbox-master/dist/simple-lightbox.jquery.min.js') }}"></script>

   @if($book->screenshot1 != '' || $book->screenshot2 != '' || $book->screenshot3 != '')
      <script>  var gallery = $('.gallery a').simpleLightbox({ });  </script>
   @endif

   <script src="{{ asset('js/books_single.js') }}"></script>

</body>
</html>