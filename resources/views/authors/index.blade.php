@extends('templates.master')
@section('content')

<div class="authors-prime-container">

   {{-- ROUTE NAME CAN BE AUTHORS.INDEX OR AUTHORS.POPULAR --}}
   <h1>
      @if(\Route::currentRouteName() == 'authors') {{ __('Авторы') }}
      @else {{ __('Популярные авторы') }}
      @endif
   </h1>

   <form class="search-author">
      <div class="search-list-container">
         <input type="text" placeholder="Найдите своего любимого автора" name="name" autocomplete="off"
         onfocus="show_authors_list()" onblur="setTimeout(hide_authors_list, 150)" onkeyup="regenerate_authors_list()">
         <button class="primary-btn primary-btn-shadow" type="button"><i class="fa fa-search"></i></button>

         {{-- AUTHORS LIST FOR AUTOCOMPLATING AUTHORS NAME --}}
         <div class="search-list">
            @foreach($allAuthors as $author)
                <a href="{{route('authors.single', $author->id)}}">{{$author->name}}</a>
            @endforeach
         </div>

      </div>
   </form>

   <div class="authors-list-container">
      <div class="authors-list">
         @foreach($authors as $author)
            <a href="{{route('authors.single', $author->id)}}">
               <div>
                  <img src="{{asset('img/authors' . '/' . $author->photo)}}">
               </div>
               <h2>{{$author->name}}</h2>
            </a>
         @endforeach
      </div>
   </div>


   {{$authors->links()}}

</div>


@endsection