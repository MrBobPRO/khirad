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

   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

   <!-- FONT AWESOME 5 -->
   <script src="https://kit.fontawesome.com/0f5643e341.js" crossorigin="anonymous"></script>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

   <link href="{{ asset('css/jqformstyler/jquery.formstyler.css') }}" rel="stylesheet">
   <link href="{{ asset('css/jqformstyler/jquery.formstyler.theme.css') }}" rel="stylesheet">

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

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

   @include('templates.scripts')

</body>
</html>