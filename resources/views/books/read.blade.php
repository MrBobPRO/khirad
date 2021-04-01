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

    <style type="text/css">
      body {
          margin: 0;
          padding: 0;
      }
      .solid-container {
        height: 100vh;
      }
    </style>
  </head>
  <body>

    <div class="flip-book-container solid-container" src="free_books/{{$filename}}"></div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/html2canvas.min.js') }}"></script>
    <script src="{{ asset('js/three.min.js') }}"></script>
    <script src="{{ asset('js/pdf.min.js') }}"></script>

    <script src="{{ asset('js/3dflipbook.min.js') }}"></script>

    <!-- To create 3D FlipBook from PDF -->
    <script type="text/javascript">
      $('.solid-container').FlipBook();
    </script>

  </body>
</html>