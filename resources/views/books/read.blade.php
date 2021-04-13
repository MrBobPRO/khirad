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
   
   <title>Читать онлайн | {{$book->name}}</title>
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

    <style>
      body {
        background-color: #333;
        margin: 0;
        padding: 0;
      }
  
      .container {
        height: 95vh;
        width: 95%;
        margin: 20px auto;
        border: 2px solid red;
        box-shadow: 0 0 5px red;
      }
  
      .fullscreen {
        background-color: #333;
      }
    </style>

</head>

<body>

  <div class="container" id="container"></div>

  <script src="js/jquery.min.js"></script>
  <script src="js/three.min.js"></script>
  <script src="js/pdf.min.js"></script>

  <script src="js/3dflipbook.min.js"></script>

  <script type="text/javascript">
    $('#container').FlipBook({
    pdf: 'free_books/{{$book->filename}}',
    
    controlsProps: {
      actions: {
        cmdFullScreen: {
          enabled: true,
        },
        cmdBackward: {
          code: 37,
        },
        cmdForward: {
          code: 39
        },
      },
    },

    template: {
      sounds: {
        startFlip: 'sounds/start-flip.mp3',
        endFlip: 'sounds/end-flip.mp3'
      },
      html: 'templates/default-book-view.html',
      styles: [
        'css/short-black-book-view.css'
      ],
      links: [
        {
          rel: 'stylesheet',
          href: 'css/font-awesome.min.css'
        }
      ],
      script: 'js/default-book-view.js'
    }
  });

  </script>
</body>

</html>