   
@extends('templates.master')
@section('content')

{{-- CONTENT WRAPPER STARTS --}}
<div class="content-wrapper">
   {{-- OWL CAROUSE START--}}
   <div class="primary-container owl-carousel-container">

      <div class="owl-navs-container">
         <a href="{{route('categories.world_most_readable')}}">Серхондатарин китобҳои ҷаҳон</a>
         <span class="owl-navs owl-nav-prev" onclick="prevSlide()">‹</span>
         <span class="owl-navs" onclick="nextSlide()">›</span>
      </div>

      <div class="owl-carousel">
         @foreach ($mostReadable as $book)
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
                     <a href="{{route('books.single', $book->latin_name)}}" style="color: {{$book->btnColor}}">Муфассал <i class="fas fa-long-arrow-alt-right"></i></a>
                  </div>

                  <div class="owl-img-container">
                     <img src="{{asset('img/books/thumbs/' . $book->photo)}}" alt="{{$book->name}}" style="box-shadow: 0 0px 10px {{$book->bgColor}}">
                  </div>

               </div>
            </div>
         @endforeach

      </div>
   </div>    {{-- OWL CAROUSE END--}}

   <div class="books-main-container">
      {{-- SEARCH STARTS --}}
      <div class="search-container">
         <h1>Пайдо кардани китобҳои лозима</h1>
         <form class="search-inner" method="GET" action="/search">
            <select class="jq-select" name="category">
               <option value="all">Ҳамаи дастабандиҳо</option>
               @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->name}}</option>
               @endforeach
            </select>

            <select class="jq-select search-year" name="year">
               <option value="all">Сол</option>
               @for($i = 1990; $i < 2022; $i++)
                  <option value="{{$i}}">{{$i}}</option>
               @endfor
            </select>

            <input id="bookName" name="keyword" type="text" minlength="3" placeholder="Номи китоб ва ё номи муаллиф"/>
            <button class="primary-btn primary-btn-shadow" type="submit">Ҷустуҷӯ</button>
         </form>
      </div>
      {{-- SEARCH END --}}

      <div class="primary-container books-with-sidebar">
         {{-- SIDEBAR START --}}
         <div class="sidebar">
            <a>
               <p class="discount-books-link">
                  Китобҳои тавсияшуда
               </p>
            </a>
            @foreach ($empfohlenBooks as $book)
                <div class="sidebar-book-block">
                   <a class="sidebar-link" href="{{route('books.single', $book->latin_name)}}"><img src="{{asset('img/books/thumbs/' . $book->photo)}}" alt="{{$book->name}}"></a>
                   <div class="sidebar-book-info">
                      <a href="{{route('books.single', $book->latin_name)}}">{{$book->name}}</a>
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
                </div>
            @endforeach
         </div>
         {{-- SIDEBAR END --}}

         {{-- LATEST RELEASE START --}}
         <div class="latest-release">
            <a class="all-books" href="{{route('books.all')}}">Китобҳои тозанашр</a>

            <div class="books-list">
               @foreach ($latestBooks as $book)
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
            <h5>Серхонандатарин</h5>
            <p>китобҳои сомона</p>
         </div>
         @foreach ($topBooks as $book)
             <div class="top-book-singe">
                <a href="{{route('books.single', $book->latin_name)}}">
                  <img src="{{asset('img/books/thumbs/' . $book->photo)}}" alt="{{$book->name}}" style="box-shadow: 0px 0px 5px -2px {{$book->bgColor}};">
                  <h2>{{$book->name}}</h2>
                </a>
                <p>
                   <i class="fas fa-user-circle"></i>
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
   </div> {{-- TOP 5 END --}}
</div> {{-- CONTENT-WRAPPER END --}}


@endsection


