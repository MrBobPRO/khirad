
@extends('authors.master')
@section('content')

<div class="author-main-container">
   {{-- AUTHORS INFO START --}}
   <div class="author-info">
      <img src="{{asset('img/authors/' . $author->photo)}}" alt="{{$author->name}}">
      <div>
         <h1>{{$author->name}}</h1>
         <p>{!!$author->biography!!}</p>
      </div>
   </div>
   {{-- AUTHORS INFO END --}}
</div>

{{-- AUTHORS BOOKS START --}}
<div class="authors-books-container">
   <h1>Китобҳои муаллиф</h1>
   <div class="authors-books-list shiny">
      @foreach ($author->books as $book)
         <div class="books-list-single">
            <a href="{{route('books.single', $book->latin_name)}}">
               <figure><img src="{{asset('img/books/thumbs/' . $book->photo)}}" alt="{{$book->name}}"></figure>
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
{{-- AUTHORS BOOKS END --}}

@endsection