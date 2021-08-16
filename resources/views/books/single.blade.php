
@extends('books.master')
@section('content')

{{-- BOOKS MAIN CONTAINER START --}}
<div class="book-main-container">
   <div class="primary-container">

      <img src="{{asset('img/books/' . $book->photo)}}" class="book-photo" alt="{{$book->name}}"> 
  
      <div class="book-info">
         <h1>{{$book->name}} | 
            {{-- GENERATE AUTHORS NAME AND CUT LAST ' & ' FROM STRING (LAST 3 SYMBOLS) --}}
            <?php 
               $authors = '';
               foreach($book->authors as $author)
                  $authors = $authors . $author->name . ' & ';
            ?>
            {{substr($authors, 0, -3)}}
         </h1>
         
         <p class="average-rating">
            @include('marks.' . $book->marksTemplate)
            &nbsp;&nbsp;{{$book->marksCount}} отзыва
         </p>

         <p class="description">{{$book->description}}</p>

         {{-- BOOK PROPERTIES START --}}
         <div class="book-properties">
            <div class="book-properties-single">
               <div class="key">Цена</div>
               <div class="value">
                  <span class="book-price">{{$book->free ? 'Бепул' : $book->price . ' сомонӣ'}}</span>
               </div>
            </div>

            <div class="book-properties-single">
               <div class="key">Автор</div>
               <div class="value">
                  @foreach ($book->authors as $author)
                     <a href="{{route('authors.single', $author->id)}}">{{$author->name}}</a>
                  @endforeach
               </div>
            </div>

            <div class="book-properties-single">
               <div class="key">Издатель</div>
               <div class="value">{{$book->publisher}}</div>
            </div>

            <div class="book-properties-single">
               <div class="key">Год выпуска</div>
               <div class="value">{{$book->year}} года</div>
            </div>

            <div class="book-properties-single">
               <div class="key">Категория</div>
               <div class="value">
                  @foreach ($book->categories as $category)
                        <a href="{{route('categories.single', $category->id)}}">{{$category->name}}</a>
                  @endforeach
               </div>
            </div>

            <div class="book-properties-single">
               <div class="key">Количество страниц</div>
               <div class="value">{{$book->pages}} страниц</div>
            </div>

            {{-- Share container --}}
            <div class="book-properties-single">
               <div class="key">Поделиться</div>
               <div class="value">
                  <div class="ya-share2" data-access-token:facebook="fb-token" 
                     data-curtain data-color-scheme="blackwhite"
                     data-services="facebook,vkontakte,telegram,viber,twitter">
                  </div>
               </div>
            </div>

            {{-- CHECK SINGLE_OLD.BLADE.PHP--}}
            <a href="/read_book?id={{$book->id}}" class="primary-btn read-book" target="_blank">
               <i class="fab fa-readme"></i> &nbsp; {{$book->free ? 'Читать книгу' : 'Читать фрагмент книги'}}
            </a>
         </div>
         {{-- BOOK PROPERTIES END --}}
   
         {{-- SCREENSHOTS START--}}
         @if($book->screenshot1 != '' || $book->screenshot2 != '' || $book->screenshot3 != '')
            <div class="gallery-container">
               <h1>Скриншоты страниц книги</h1>
               <div class="gallery">
                  @if($book->screenshot1 != '')
                     <a href="{{asset('img/screenshots/' .  $book->screenshot1)}}" class="big">
                        <img src="{{asset('img/screenshots/' .  $book->screenshot1)}}">
                     </a>
                  @endif

                  @if($book->screenshot2 != '')
                     <a href="{{asset('img/screenshots/' .  $book->screenshot2)}}" class="big">
                        <img src="{{asset('img/screenshots/' .  $book->screenshot2)}}">
                     </a>
                  @endif

                  @if($book->screenshot3 != '')
                     <a href="{{asset('img/screenshots/' .  $book->screenshot3)}}" class="big">
                        <img src="{{asset('img/screenshots/' .  $book->screenshot3)}}">
                     </a>
                  @endif
               </div>
            </div>
         @endif
         {{-- SCREENSHOTS END--}}


         {{-- REVIEWS CONTAINER START --}}
         <div class="reviews-container">
            <h1>Отзывы и оценки о товаре</h1>

            {{-- AVERAGE RATING START --}}   
            <div class="reviews-average-rating">
               <p>Средняя оценка пользователей :</p>
               <p>
                  @include('marks.' . $book->marksTemplate)
                  &nbsp;&nbsp;{{$book->marksCount}} отзыва
               </p>
            </div>
            {{-- AVERAGE RATING END --}}   

            {{-- IF THERE ARE NO REVIEWS --}}
            @if($book->marksCount == 0) <p class="no-reviews">Отзывы о товаре отсуствуют.</p> @endif
            {{-- ADD NEW REVIEW--}}
            <div class="add-review">
               <a data-bs-toggle="collapse" href="#reviews-collapse" role="button" aria-expanded="false" aria-controls="reviews-collapse" class="collapsed">
               <i class="fa fa-plus"></i> Добавить свой отзыв</a>
            </div>   

            {{-- ADD REVIEW FORM --}}
            <div class="collapse" id="reviews-collapse">
               <form action="/reviews-store" id="review_store" method="POST">
                  @csrf
                  <input type="hidden" name="book_id" value="{{$book->id}}">
                  <input class="d-none" name="mark" value="1">
                  <label>Ваша оценка<span>*</span></label>
                  <p id="add-review-stars">@include('marks.select')</p>
                  <label>Ваш отзыв</label>
                  <textarea name="body" rows="5"></textarea>
                  <button type="submit" id="review_store_btn" class="primary-btn"><i class="fa fa-send"></i> Отправить</button>
               </form>
            </div>
            
            {{-- REVIEWS LIST --}}
            @foreach ($reviews as $review)
            <div class="review-single-block">
               <div class="review-header" @if($review->body == '') style="margin: 0" @endif>
                  <h6>Гость</h6>
                  <p>
                     <?php $date = \Carbon\Carbon::parse($review->updated_at)->locale('ru');
                     $formatted = $date->isoFormat('DD MMMM YYYY') ?>
                     <span class="review-date">{{$formatted}}</span>
                     @include('marks.' . $review->mark)
                  </p>
               </div>
               <p>{{$review->body}}</p>
            </div>
            @endforeach
         </div> {{-- REVIEWS CONTAINER END --}}

      </div>  {{-- BOOK INFO END --}}
   </div>  {{-- PRIMARY CONTAINER END --}}
</div>  {{-- BOOKS MAIN CONTAINER END --}}


@endsection