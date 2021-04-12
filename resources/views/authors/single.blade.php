
@extends('authors.master')
@section('content')

<div class="author-main-container">
   {{-- AUTHORS INFO START --}}
   <div class="author-info">
      <img src="{{asset('img/authors' . '/' . $author->photo)}}">
      <div>
         <h1>{{$author->name}}</h1>
         <p>{!!$author->description!!}</p>
      </div>
   </div>
   {{-- AUTHORS INFO END --}}
</div>

{{-- AUTHORS BOOKS START --}}
<div class="authors-books-container">
   <h1>Книги автора</h1>
   <div class="authors-books-list">
      @foreach ($author->books as $book)
         <div class="books-list-single">
            <a href="{{route('books.single', $book->id)}}">
               <img src="{{asset('img/thumbs/' . $book->photo)}}">
               <h2>{{$book->name}}</h2>
            </a>
            <p>
               {{-- <i class="fa fa-user"></i> &nbsp; --}}
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
{{-- AUTHORS BOOKS END --}}

@endsection