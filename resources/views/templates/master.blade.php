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
   
   <title>Хирад</title>
   <meta name="keywords" content="книги, бесплатные книги, онлайн библиотека, купить книги в Таджикистане, читать книги онлайн"/>

   {{-- Opengraph --}}
   <?php $shareText = 'Книга — один из видов печатной продукции: непериодическое издание, состоящее из сброшюрованных или отдельных бумажных листов (страниц) или тетрадей, на которых нанесе...'; ?>
   <meta name="description" content="{{$shareText}}">
   <meta property="og:description" content="{{$shareText}}">
   <meta property="og:locale" content="ru_RU" />
   <meta property="og:type" content="object" />
   <meta property="og:title" content="Хирад" />
   <meta property="og:site_name" content="Хирад" />
   <meta property="og:image" content="{{ asset('img/main/logo-share.png') }}">
   <meta name="twitter:card" content="summary_large_image">
   <meta name="twitter:title" content="Хирад">
   <meta name="twitter:image" content="{{ asset('img/main/logo-share.png') }}">
 
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
   {{-- JQueryFormStyler --}}
   <link href="{{ asset('css/jqformstyler/jquery.formstyler.css') }}" rel="stylesheet">
   <link href="{{ asset('css/jqformstyler/jquery.formstyler.theme.css') }}" rel="stylesheet">
   {{-- Select2 --}}
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

   <link href="{{ asset('css/main/styles.css') }}" rel="stylesheet">
   <link href="{{ asset('css/main/modal.css') }}" rel="stylesheet">

   @include('templates.styles')

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

   @include('templates.scripts')

</body>
</html>