
@extends('categories.master')

@section('content')
<div class="primary-container content-wrapper">
   <h1>
      {{-- CHANGE MAIN TITLE ACCORDING TO ROUTE NAME --}}
      @if($route == 'categories.single') {{$category->name}}
      @elseif($route == 'categories.discounts') {{ __('Актуальные скидки') }}
      @elseif($route == 'categories.popular') {{ __('Популярные книги') }}
      @elseif($route == 'categories.rating') {{ __('Книги с высокими рейтингами') }}
      @elseif($route == 'categories.bestsellers') {{ __('Бестселлеры') }}
      @elseif($route == 'categories.free') {{ __('Онлайн читалка') }}
      @elseif($route == 'books.all') {{ __('Все книги') }}
      @endif
   </h1>
   <div class="books-list">
      @foreach ($books as $book)
      <div class="books-list-single">
         <a href="{{route('books.single', $book->id)}}">
            <img src="{{asset('img/thumbs/' . $book->photo)}}">
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
            &nbsp;&nbsp;{{$book->marksCount}} отзыва</p>

         @elseif($route == 'categories.bestsellers')
         <p>Покупок : {{$book->sales}}</p>
         @endif
         
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

   {{ $books->links() }}

</div>
@endsection