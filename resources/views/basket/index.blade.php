
@extends('templates.master')
@section('content')

<div class="primary-container baskets-main-container">
   <h1>Корзина</h1>

   <div class="basket-inner-div">
      {{-- BASKET INNER LEFT START --}}
      <div class="basket-inner-left">
         <div class="basket-header">
            <h2>Ваша корзина покупок</h2>
            <h2>
               {{$books ? count($books) . ' книг' : '0 книг'}}
            </h2>
         </div>

         {{-- BOOKS LIST START --}}
         @if($books && count($books) > 0)
            {{-- SHOW BOOKS LIST IF BASKET ISNT EMPTY --}}
            @foreach($books as $book)
               <div class="books-list-single">
                  <a href="{{route('books.single', $book->id)}}"><img src="{{asset('img/thumbs/' . $book->photo)}}"></a>
                  <div class="name">{{$book->name}}</div>
                  <div class="author">
                     <i class="fas fa-user-circle"></i> &nbsp;
                     {{-- GENERATE AUTHORS NAME AND CUT LAST ' & ' FROM STRING (LAST 3 SYMBOLS) --}}
                     <?php 
                        $authors = '';
                        foreach($book->authors as $author)
                           $authors = $authors . $author->name . ' & ';
                     ?>
                     {{substr($authors, 0, -3)}}
                  </div>
                  <div class="price">{{$book->discountPrice != 0 ? $book->discountPrice : $book->price}} сом</div>

                  <form method="POST" action="/remove_from_basket">
                     @csrf
                     <input type="hidden" name="book_id" value="{{$book->id}}">
                     <button type="submit" class="primary-btn"><i class="fas fa-trash"></i></button>
                  </form>
               </div>
            @endforeach

            <form method="POST" action="/empty_basket">
               @csrf
               <button type="submit" class="primary-btn empty-basket"><i class="far fa-trash-alt"></i> &nbsp;Очистить корзину</button>
            </form>

         @else
            {{-- ELSE SHOW EMPTY BASKET --}}
            <p>Пока что у вас тут пусто!</p>
         @endif
      </div>
      {{-- BASKET INNER LEFT END --}}

      {{-- BASKET INNER RIGHT START --}}
      <div class="basket-iner-right">
         <h2>Оформить заказ</h2>
         <div class="books-count">
            <p>Всего :</p>
            <p>{{$books ? count($books) : 0}} книг</p>
         </div>
         
         <div class="discounted-price">
            <p>Скидка :</p>
            <p>{{$discountedPrice}} сом.</p>
         </div>

         <div class="total-price">
            <p>Итого :</p>
            <p><b>{{$basketPrice}} сом.</b></p>
         </div>

         <form method="POST" action="/checkout">
            @csrf
            <button class="primary-btn"
               {{-- DISABLE BUTTON IF USER IS GUEST OR WHEN BASKET IS EMPTY --}}
               @if(!\Auth::check()) disabled
               @elseif(\Auth::check() && count($books) == 0) disabled
               @endif
            >
               <i class="fas fa-money-check"></i> &nbsp;Оформить заказ
            </button>
         </form>

         <h4>Мы принимаем :</h4>
         <div class="accepts">
            <img src="{{asset('img/basket/visa.jpg')}}">
            <img src="{{asset('img/basket/alif.png')}}">
            <img src="{{asset('img/basket/mc.png')}}">
            <img src="{{asset('img/basket/dc.png')}}">
         </div>
      </div>
      {{-- BASKET INNER RIGHT END --}}

   </div> {{-- BASKET INNER DIV END --}}
</div> {{-- BASKET MAIN ONTAINER END --}}



@endsection