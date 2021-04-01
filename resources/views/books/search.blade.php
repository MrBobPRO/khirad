
@extends('templates.master')

@section('content')
<div class="primary-container content-wrapper">
   <h1>Поиск книг</h1>
   @if($booksCount == 0)
      <p class="search-results">Увы по вашему запросу ничего не найдено. Попробуйте новый поиск!</p>
   @else 
      <p class="search-results"> Поиск по ключевму слову '{{$keyword}}'. Найдено {{$booksCount}} результата(-ов)</p>
   @endif
   <div class="books-list">
      @foreach ($books as $book)
      <div class="books-list-single">
         <a href="{{route('books.single', $book->id)}}">
            <img src="{{asset('img/books/' . $book->photo)}}">
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

         @if($book->isFree)
         <span class="book-price">Бесплатная</span>
         @elseif($book->discountPrice == 0)
         <span class="book-price">{{$book->price}} сом.</span>
         @else
         <span class="book-price-stroked">{{$book->price}} сом.</span>
         <span class="book-price">{{$book->discountPrice}} сом.</span>
         @endif
      </div>   
   @endforeach
   </div>

</div>
@endsection