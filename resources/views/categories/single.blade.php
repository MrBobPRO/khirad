
@extends('categories.master')

@section('content')
<div class="primary-container content-wrapper">
   <?php $route = \Route::currentRouteName(); ?>
   <h1>
      {{-- CHANGE MAIN TITLE ACCORDING TO ROUTE NAME --}}
      @if($route == 'categories.single') {{$category->name}}
      @elseif($route == 'books.all') Ҳамаи китобҳо
      @elseif($route == 'categories.rating') Китобҳои бо баҳои баланд
      @elseif($route == 'categories.world_most_readable') Серхондатарин китобҳои ҷаҳон
      @elseif($route == 'categories.site_most_readable') Серхондатарин китобҳои сомона
      @elseif($route == 'categories.foreign_books') Китобҳои хориҷӣ
      @endif
   </h1>

   @if($route == 'categories.single' && $books->currentPage() < 2) 
      <p class="category-description">{{$category->description}}</p>
   @endif

   <div class="books-list">
      @foreach ($books as $book)
      <div class="books-list-single">
         <a href="{{route('books.single', $book->latin_name)}}">
            <img src="{{asset('img/books/thumbs/' . $book->photo)}}" alt="{{$book->name}}">
            <h2>{{$book->name}}</h2>
         </a>
         <p>
            {{-- GENERATE AUTHORS NAME AND CUT LAST ' & ' FROM STRING (LAST 3 SYMBOLS) --}}
            <?php 
               $authors = '';
               foreach($book->authors as $author)
                  $authors = $authors . $author->name . ' & ';
            ?>
            {{substr($authors, 0, -3)}}
         </p>

         @if($route == 'categories.rating')
         <p>@include('marks.' . $book->marksTemplate)
            &nbsp;&nbsp;{{$book->marksCount}} мулоҳиза</p>

         @elseif($route == 'categories.site_most_readable')
            <p>Шумори мутолиа : <b>{{$book->number_of_readings}}</b></p>
         @endif
         
      </div>   
   @endforeach
   </div>

   {{ $books->links() }}

</div>
@endsection