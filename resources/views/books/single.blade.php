
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
            &nbsp;&nbsp;{{$book->marksCount}} мулоҳиза
         </p>

         <p class="description">{{$book->description}}</p>

         {{-- BOOK PROPERTIES START --}}
         <div class="book-properties">
            <div class="book-properties-single">
               <div class="key">Нарх</div>
               <div class="value">
                  <span class="book-price">{{$book->free ? 'Ройгон' : $book->price . ' сомонӣ'}}</span>
               </div>
            </div>

            <div class="book-properties-single">
               <div class="key">
                  {{ count($book->authors) > 1 ? 'Муаллифон' : 'Муаллиф'}}
               </div>
               <div class="value">
                  @foreach ($book->authors as $author)
                     <a href="{{route('authors.single', $author->latin_name)}}">{{$author->name}}</a>
                  @endforeach
               </div>
            </div>

            <div class="book-properties-single">
               <div class="key">Ношир</div>
               <div class="value">{{$book->publisher}}</div>
            </div>

            <div class="book-properties-single">
               <div class="key">Соли табъ</div>
               <div class="value">{{$book->year}} сол</div>
            </div>

            <div class="book-properties-single">
               <div class="key">Дастабандӣ</div>
               <div class="value">
                  @foreach ($book->categories as $category)
                        <a href="{{route('categories.single', $category->latin_name)}}">{{$category->name}}</a>
                  @endforeach
               </div>
            </div>

            <div class="book-properties-single">
               <div class="key">Шумори саҳифаҳо</div>
               <div class="value">{{$book->pages}} саҳифа</div>
            </div>

            <div class="book-properties-single">
               <div class="key">Шумори мутолиа</div>
               <div class="value">{{$book->number_of_readings}} маротиба</div>
            </div>

            {{-- Share container --}}
            <div class="book-properties-single">
               <div class="key">Ба иштирок гузоштан</div>
               <div class="value">
                  <div class="ya-share2" data-access-token:facebook="fb-token" 
                     data-curtain data-color-scheme="blackwhite"
                     data-services="facebook,vkontakte,telegram,viber,twitter">
                  </div>
               </div>
            </div>

            @if($book->free)
               <a href="/read_book?name={{$book->latin_name}}" class="primary-btn read-book" target="_blank">
                  <i class="fas fa-book-open"></i> &nbsp; Хондани китоб
               </a>
            @else
               <a href="/read_book?name={{$book->latin_name}}" class="primary-btn read-payed-book" target="_blank">
                  <i class="fas fa-book-open"></i> &nbsp; Хондани қисмате аз китоб
               </a>

               <button class="primary-btn" data-bs-toggle="modal" data-bs-target="#buyModal"><i class="fas fa-coins"></i> &nbsp; Фармоиши китоб</button>
            @endif
         </div>
         {{-- BOOK PROPERTIES END --}}
   
         {{-- SCREENSHOTS START--}}
         @if($book->screenshot1 != '' || $book->screenshot2 != '' || $book->screenshot3 != '')
            <div class="gallery-container">
               <h1>Намобардориҳои саҳифаҳои китоб</h1>
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
            <h1>Баррасӣ ва арзёбии китоб</h1>

            {{-- AVERAGE RATING START --}}   
            <div class="reviews-average-rating">
               <p>Баҳогузории миёнаи корбарон :</p>
               <p>
                  @include('marks.' . $book->marksTemplate)
                  &nbsp;&nbsp;{{$book->marksCount}} мулоҳиза
               </p>
            </div>
            {{-- AVERAGE RATING END --}}   

            {{-- IF THERE ARE NO REVIEWS --}}
            @if($book->marksCount == 0) <p class="no-reviews">Андешаю мулоҳиза дар мавриди китоб вуҷуд надорад.</p> @endif
            {{-- ADD NEW REVIEW--}}
            <div class="add-review">
               <a data-bs-toggle="collapse" href="#reviews-collapse" role="button" aria-expanded="false" aria-controls="reviews-collapse" class="collapsed">
               <i class="fa fa-plus"></i> Илова кардани мулоҳизаи нав</a>
            </div>   

            {{-- ADD REVIEW FORM --}}
            <div class="collapse" id="reviews-collapse">
               <form action="/reviews-store" id="review_store" method="POST">
                  @csrf
                  <input type="hidden" name="book_id" value="{{$book->id}}">
                  <input class="d-none" name="mark" value="1">
                  <label>Баҳои Шумо<span>*</span></label>
                  <p id="add-review-stars">@include('marks.select')</p>
                  <label>Номи Шумо</label>
                  <input type="text" name="user_name"></input>
                  <label>Мулоҳизаи Шумо</label>
                  <textarea name="body" rows="5"></textarea>
                  <button type="submit" id="review_store_btn" class="primary-btn"><i class="fa fa-send"></i> &nbsp;Фиристодан</button>
               </form>
            </div>
            
            {{-- REVIEWS LIST --}}
            @foreach ($reviews as $review)
            <div class="review-single-block">
               <div class="review-header" @if($review->body == '') style="margin: 0" @endif>
                  <p>
                     @include('marks.' . $review->mark)
                     <?php $date = \Carbon\Carbon::parse($review->updated_at)->locale('ru');
                     $formatted = $date->isoFormat('DD.MM.YYYY') ?>
                  </p>
                  <h6>{{$review->user_name == '' ? 'Хонанда' : $review->user_name}}</h6>
               </div>
               <span class="review-date">{{$formatted}}</span>
               <p class="review-body">{{$review->body}}</p>
            </div>
            @endforeach
         </div> {{-- REVIEWS CONTAINER END --}}

      </div>  {{-- BOOK INFO END --}}
   </div>  {{-- PRIMARY CONTAINER END --}}
</div>  {{-- BOOKS MAIN CONTAINER END --}}



<!-- Disliked Modal -->
<div class="modal fade grades-modal" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="buyModalLabel">Фармоиш додани китоб</h5>
         </div>

         <form action="/order_book" method="POST">
            @csrf
            <div class="modal-body">
               <p>Маълумоти хешро ба мо ирсол намоед ва мо барои баррасии минбаъда бо Шумо дар тамос хоҳем шуд !</p>
               <label for="user_name"><i class="fas fa-user"></i> &nbsp;Номи шумо</label>
               <input type="text" name="name" id="user_name" required>
               <label for="user_mobile"><i class="fas fa-phone"></i> &nbsp;Рақамҳои мобилии Шумо</label>
               <input type="text" name="phone" id="user_mobile" required>
            </div>
   
            <div class="modal-footer">
               <button type="button" class="cancel-btn" data-bs-dismiss="modal">Пӯшидан</button>
               <button type="submit" class="primary-btn">Фиристодан</button>
            </div>
         </form>

      </div>
   </div>
</div>


@endsection