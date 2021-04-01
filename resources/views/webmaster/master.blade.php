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
   
   <title>Хирад | Вэбмастер</title>

   <!-- FONT AWESOME 5 -->
   <script src="https://kit.fontawesome.com/0f5643e341.js" crossorigin="anonymous"></script>
   {{-- Roboto Font --}}
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
   {{-- Bootstrap 5.0 --}}
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
   {{-- JQuery Form Styler 2.0.1 --}}
   <link href="{{ asset('js/JQueryFormStyler/jquery.formstyler.css') }}" rel="stylesheet">
   <link href="{{ asset('js/JQueryFormStyler/jquery.formstyler.theme.css') }}" rel="stylesheet">
   {{-- Select2 --}}
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   {{-- Spectrum ColorPicker --}}
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.css">

   <link href=" {{ asset('css/webmaster/styles.css') }}" rel="stylesheet" />

</head>
<body>
   
   <div class="spinner-container" id="spinner-container">
      <div class="spinner-border" role="status">
         <span class="sr-only">Loading...</span>
       </div>
       <div id="spinner_info">Пожалуйста дождитесь загрузки файлов на сервер!</div>
       <div class="spinner-file-size" >
         <span id="spinner_file1"></span>
         <span id="spinner_file2"></span>
       </div>
   </div>

   <div class="primary-container">
      @include('webmaster.dashboard')
      <div class="content">
         @yield('content')
      </div>
   </div>

   {{-- JQery 3.6.0 --}}
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   {{-- Bootstrap 5.0.0 --}}
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
   {{-- Select2 --}}
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   {{-- JQuery Form Styler 2.0.1 --}}
   <script src=" {{asset('js/JQueryFormStyler/jquery.formstyler.min.js') }}"></script>
   {{-- Spectrum ColorPicker --}}
   <script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
   
   <script src=" {{ asset('js/webmaster.js') }}"></script>

</body>
</html>