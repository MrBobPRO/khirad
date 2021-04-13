   
@extends('templates.master')
@section('content')

{{-- CONTENT WRAPPER STARTS --}}
<div class="content-wrapper">
   {{-- OWL CAROUSE START--}}
   <div class="primary-container owl-carousel-container">
      <div class="owl-navs-container">
         <a href="{{route('categories.popular')}}">{{__('Популярные книги наших дней')}}</a>
         <span class="owl-navs owl-nav-prev" onclick="prevSlide()">‹</span>
         <span class="owl-navs" onclick="nextSlide()">›</span>
      </div>
      <div class="owl-carousel">
         @foreach ($popularBooks as $book)
         <div class="item" style="background-color: {{$book->bgColor}}; color: {{$book->txtColor}}">
            <h1>{{$book->name}}</h1>
            <div class="owl-item-inner">
               <div class="owl-book-info">
                  <p class="owl-book-author"><i class="fas fa-user-circle"></i>
                     {{-- GENERATE AUTHORS NAME AND CUT LAST ' & ' FROM STRING (LAST 3 SYMBOLS) --}}
                     <?php 
                        $authors = '';
                        foreach($book->authors as $author)
                           $authors = $authors . $author->name . ' & ';
                     ?>
                     {{substr($authors, 0, -3)}}
                  </p>
                  <p class="owl-marks">@include('marks.' . $book->marksTemplate)
                     &nbsp;&nbsp;{{$book->marksCount}} отзыва</p>
                  <p class="owl-book-desc">{{$book->description}}</p>
                  <a href="{{route('books.single', $book->id)}}" style="color: {{$book->btnColor}}">Подробнее <i class="fas fa-long-arrow-alt-right"></i></a>
               </div>
               <div class="owl-img-container">
                  <img src="{{asset('img/thumbs/' . $book->photo)}}" alt="{{$book->name}}" style="box-shadow: 0 0px 10px {{$book->bgColor}}">
               </div>
            </div>
         </div>
         @endforeach

      </div>
   </div>    {{-- OWL CAROUSE END--}}

   <div class="books-main-container">
      {{-- SEARCH STARTS --}}
      <div class="search-container">
         <h1>{{__('Найдите нужную книгу')}}</h1>
         <form class="search-inner" method="GET" action="/search">
            <select class="jq-select" name="category">
               <option value="all">{{__('Все категории')}}</option>
               @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$curLocale == 'tj' ? $category->name : $category->russian_name}}</option>
               @endforeach
            </select>

            <select class="jq-select search-year" name="year">
               <option value="all">{{__('Год')}}</option>
               @for($i = 1990; $i < 2022; $i++)
                  <option value="{{$i}}">{{$i}}</option>
               @endfor
            </select>

            <input id="bookName" name="keyword" type="text" minlength="3" placeholder="{{__('Название книги или имя автора')}}"/>
            <button class="primary-btn primary-btn-shadow" type="submit">{{__('Поиск')}}</button>
         </form>
      </div>
      {{-- SEARCH END --}}

      <div class="primary-container books-with-sidebar">
         {{-- SIDEBAR START --}}
         <div class="sidebar">
            <a href="{{route('categories.discounts')}}"><p class="discount-books-link">{{__('Актуальные скидки')}}</p></a>
            @foreach ($discountedBooks as $book)
                <div class="sidebar-book-block">
                   <a class="sidebar-link" href="{{route('books.single', $book->id)}}"><img src="{{asset('img/thumbs/' . $book->photo)}}" alt="{{$book->name}}"></a>
                   <div class="sidebar-book-info">
                      <a href="{{route('books.single', $book->id)}}">{{$book->name}}</a>
                      <p>
                        {{-- GENERATE AUTHORS NAME AND CUT LAST ' & ' FROM STRING (LAST 3 SYMBOLS) --}}
                        <?php 
                           $authors = '';
                           foreach($book->authors as $author)
                              $authors = $authors . $author->name . ' & ';
                        ?>
                        {{substr($authors, 0, -3)}}
                     </p>
                      <span class="book-price-stroked">{{$book->price}} сом.</span>
                      <span class="book-price">{{$book->discountPrice}} сом.</span>
                   </div>
                </div>
            @endforeach
         </div>
         {{-- SIDEBAR END --}}

         {{-- LATEST RELEASE START --}}
         <div class="latest-release">
            <a class="all-books" href="{{route('books.all')}}">{{__('Недавно добавленные')}}</a>

            <div class="books-list">
               @foreach ($latestBooks as $book)
                  <div class="books-list-single">
                     <a href="{{route('books.single', $book->id)}}">
                        <img src="{{asset('img/thumbs/' . $book->photo)}}" alt="{{$book->name}}">
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
                     <span class="book-price">{{__('Бесплатная')}}</span>
                     @elseif($book->discountPrice == 0)
                     <span class="book-price">{{$book->price}} сом.</span>
                     @else
                     <span class="book-price-stroked">{{$book->price}} сом.</span>
                     <span class="book-price">{{$book->discountPrice}} сом.</span>
                     @endif
                  </div>   
               @endforeach
            </div>
         </div>    {{-- LATEST RELEASE END --}}
      </div>    {{-- BOOKS-WITH-SIDEBAR END --}}
   </div>   {{-- BOOKS-MAIN CONTAINER END --}}


   {{-- TOP 5 START --}}
   <div class="top5">
      <div class="primary-container top5-inner">
         <div class="top5-title">
            @if(app()->getLocale() == 'ru')
               <h3>{{__('Наш')}}</h3>
               <h2>{{__('ТОП 5')}}</h2>
            @else
               <h5>Серхонандатаринҳо</h3>
            @endif
            <p>{{__('Самые лучшие книги среди всех')}}</p>
         </div>
         @foreach ($topBooks as $topBook)
             <div class="top-book-singe">
                <a href="{{route('books.single', $topBook->id)}}">
                  <img src="{{asset('img/thumbs/' . $topBook->photo)}}" alt="{{$book->name}}" style="box-shadow: 0px 0px 5px -2px {{$topBook->bgColor}};">
                  <h2>{{$topBook->name}}</h2>
                </a>
                <p>
                   <i class="fas fa-user-circle"></i>
                  {{-- GENERATE AUTHORS NAME AND CUT LAST ' & ' FROM STRING (LAST 3 SYMBOLS) --}}
                  <?php 
                     $authors = '';
                     foreach($topBook->authors as $author)
                        $authors = $authors . $author->name . ' & ';
                  ?>
                  {{substr($authors, 0, -3)}}
               </p>
             </div>
         @endforeach
      </div>
   </div> {{-- TOP 5 END --}}
</div> {{-- CONTENT-WRAPPER END --}}


@endsection


