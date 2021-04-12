
@extends('books.master')
@section('content')

{{-- BOOKS MAIN CONTAINER START --}}
<div class="book-main-container">
   <div class="primary-container">

      <img src="{{asset('img/books/' . $book->photo)}}" class="book-photo"> 
  
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
                  @if($book->isFree)
                  <span class="book-price">Бесплатная</span>
                  @elseif($book->discountPrice == 0)
                  <span class="book-price">{{$book->price}} сом.</span>
                  @else
                  <span class="book-price-stroked">{{$book->price}} сом.</span>
                  <span class="book-price">{{$book->discountPrice}} сом.</span>
                  @endif
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

            {{-- IF ITS FREE BOOK SHOW READ BOOK LINK. ELSE SHOW ADD INTO BASKET/REMOVE FROM BASKET/DOWNLOAD BOOK LINKS --}}
            @if($book->isFree) <a href="/read_book?id={{$book->id}}" class="primary-btn read-book" target="_blank">
               <i class="fab fa-readme"></i> &nbsp; Читать книгу</a>

            {{-- ELSE SHOW ADD INTO BASKET/REMOVE FROM BASKET/DOWNLOAD LINKS --}}
            @else

               @if($auth)
                  {{-- CHECK IF USER HAS ALREADY ADDED THIS BOOK INTO BASKET --}}
                  @if($basketed) 
                     <form action="/remove_from_basket" method="POST" id="remove_from_basket">
                        @csrf
                        <input type="hidden" name="book_id" value="{{$book->id}}">
                        <button class="primary-btn" id="remove_from_basket_btn"><i class="far fa-trash-alt"></i> &nbsp; Убрать из корзины</button>
                     </form>

                  {{-- ELSE If USER HASNT ALREADY ADDED THIS BOOK INTO BASKET AND HASNT OBTAINED IT YET --}}
                  @elseif(!$basketed && !$obtained)
                     <form action="/add_into_basket" method="POST" id="add_into_basket">
                        @csrf
                        <input type="hidden" name="book_id" value="{{$book->id}}">
                        <button class="primary-btn" id="add_into_basket_btn"><i class="fas fa-cart-plus"></i>
                           &nbsp; В корзину {{$book->price == $book->discount ? $book->price : $book->discount}} сом
                        </button>
                     </form>
                  
                  {{-- ELSE IF USER HAS ALREADY OBTAINED IT --}}
                  @elseif($obtained)
                     <form method="POST" action="/archive/download">
                        @csrf
                        <input type="hidden" name="book_id" value="{{$book->id}}">
                        <button type="submit" class="primary-btn"><i class="fas fa-cloud-download-alt"></i> &nbsp;Скачать</button>
                     </form>
                  @endif
               @else 
                  {{-- CASE GUEST SHOW LOGIN MODAL --}}
                  <button class="primary-btn" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-cart-plus"></i>
                     &nbsp; В корзину {{$book->discountPrice == 0 ? $book->price : $book->discountPrice}} сом
                  </button>
               @endif  {{-- if($book->isFree) --}}

            @endif  {{-- if($auth) --}}
         </div>
         {{-- BOOK PROPERTIES END --}}
   
         {{-- SCREENSHOTS START--}}
         {{-- THERE ARE NO SCREENSHOTS FOR FREE BOOKS --}}
         @if(!$book->isFree)
            <div class="gallery-container">
               <h1>Скриншоты страниц книги</h1>
               <div class="gallery">
                  <a href="{{asset('img/screenshots/' .  $book->screenshot1)}}" class="big">
                     <img src="{{asset('img/screenshots/' .  $book->screenshot1)}}">
                  </a>
                  <a href="{{asset('img/screenshots/' .  $book->screenshot2)}}" class="big">
                     <img src="{{asset('img/screenshots/' .  $book->screenshot2)}}">
                  </a>
                  <a href="{{asset('img/screenshots/' .  $book->screenshot3)}}" class="big">
                     <img src="{{asset('img/screenshots/' .  $book->screenshot3)}}">
                  </a>
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


            {{-- IF USER IS GUEST --}}
            @if(!$auth)
               {{-- LOGIN TO VOTE --}}
               <p class="login-to-vote"><a data-bs-toggle="modal" href="#loginModal">Войдите</a> чтобы оставить отзыв!</p> 
               {{-- IF THERE ARE NO REVIEWS --}}
               @if($book->marksCount == 0)
                  <p class="no-reviews">Отзывы о товаре отсуствуют.</p>
               @else
                  @foreach ($book->reviews as $review)
                  <div class="review-single-block">
                     <div class="review-header" @if($review->body == '') style="margin: 0" @endif>
                        <h6>{{$review->author->name}}</h6>
                        <p>
                           <?php $date = \Carbon\Carbon::parse($review->created_at)->locale('ru');
                           $formatted = $date->isoFormat('DD MMMM YYYY') ?>
                           <span class="review-date">{{$formatted}}</span>
                           @include('marks.' . $review->mark)
                        </p>
                     </div>
                     <p>{{$review->body}}</p>
                  </div>
                  @endforeach
               @endif
            
            {{-- ELSE IF USER HAS AUTH --}}
            @else
               {{-- IF THERE ARE NO REVIEWS --}}
               @if($book->marksCount == 0) <p class="no-reviews">Отзывы о товаре отсуствуют.</p> @endif
               {{-- IF USER DIDN`T VOTE YET--}}
               @if(count($usersReview) == 0)
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
               @endif
               
               {{-- REVIEWS LIST --}}
               @foreach ($reviews as $review)
               <div class="review-single-block">
                  <div class="review-header" @if($review->body == '') style="margin: 0" @endif>
                     <h6>{{$review->author->name}}</h6>
                     <p>
                        <?php $date = \Carbon\Carbon::parse($review->updated_at)->locale('ru');
                        $formatted = $date->isoFormat('DD MMMM YYYY') ?>
                        <span class="review-date">{{$formatted}}</span>
                        @include('marks.' . $review->mark)
                     </p>
                  </div>
                  <p>{{$review->body}}</p>
                  
                  {{-- SHOW BADGET AND ADD REVIEW CHANGE FORM CASE ITS USERS REVIEW --}}
                  @if($review->user_id == \Auth::id())
                     <a data-bs-toggle="collapse" href="#reviews-collapse" role="button" aria-expanded="false" aria-controls="reviews-collapse" class="users-review-badget"><i class="fa fa-pencil"></i></a>

                     <div class="collapse" id="reviews-collapse">
                        <form action="/reviews-edit" method="POST" id="reviews_edit">
                           @csrf
                           <input type="hidden" name="book_id" value="{{$book->id}}">
                           <input type="hidden" name="review_id" value="{{$review->id}}">
                           <input class="d-none" name="mark" value="1">
                           <label>Ваша оценка<span>*</span></label>
                           <p id="edit-review-stars">@include('marks.select')</p>
                           <label>Ваш отзыв</label>
                           <textarea name="body" rows="5"></textarea>
                           <button class="primary-btn" id="reviews_edit_btn"><i class="fa fa-pencil"></i> &nbsp;Обновить отзыв</button>
                        </form>
                     </div>
                  @endif
               </div>
               @endforeach

            @endif

         </div> {{-- REVIEWS CONTAINER END --}}

      </div>  {{-- BOOK INFO END --}}
   </div>  {{-- PRIMARY CONTAINER END --}}
</div>  {{-- BOOKS MAIN CONTAINER END --}}


@endsection