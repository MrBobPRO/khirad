
@extends('templates.master')

@section('content')
<div class="primary-container content-wrapper">
   <h1>Ҷустуҷӯи китобҳо</h1>
   @if($booksCount == 0)
      <p class="search-results">Дархости шумо бе натиҷа анҷом ёфт. Ҷустуҷӯйи навро санҷед!</p>
   @else 
      <p class="search-results"> Ҷустуҷӯ тавассути вожаи <b>'{{$keyword}}'</b>. Пайдо шуд {{$booksCount}} натиҷа (ҳо)</p>
   @endif
   <div class="books-list">
      @foreach ($books as $book)
      <div class="books-list-single">
         <a href="{{route('books.single', $book->latin_name)}}">
            <img src="{{asset('img/books/thumbs/' . $book->photo)}}">
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
      </div>   
   @endforeach
   </div>

</div>
@endsection