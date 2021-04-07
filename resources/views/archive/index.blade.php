
@extends('templates.master')
@section('content')

<div class="primary-container archive-container">
      <h1>Архив</h1>
      <p class="archive-desc">Здесь будут хранятся ваши купленные книги. Вы сможете скачать их заново когда захотите.</p>

      {{-- CASE ITS GUEST --}}
      @guest<p class="login-txt"><a data-bs-toggle="modal" href="#loginModal">Войдите</a> чтобы посетить свой архив.</p>@endguest

      {{-- CASE USER HAS AUTH --}}
      @auth
         {{-- IF THERE ARE NO BOOKS --}}
         @if(count($books) == 0)
            <p class="no-books">У вас пока что нету купленных книг.</p>

         {{-- ELSE SHOW BOOKS LIST --}}
         @else
            <div class="books-list">
               @foreach ($books as $book)
                  <div class="books-list-single">
                     <a href="{{route('books.single', $book->id)}}"><img src="{{asset('img/thumbs/' . $book->photo)}}"></a>
                     <div class="name">{{$book->name}}</div>
                     <div class="author">
                        <i class="fa fa-user-circle"></i> &nbsp;
                        {{-- GENERATE AUTHORS NAME AND CUT LAST ' & ' FROM STRING (LAST 3 SYMBOLS) --}}
                        <?php 
                           $authors = '';
                           foreach($book->authors as $author)
                              $authors = $authors . $author->name . ' & ';
                        ?>
                        {{substr($authors, 0, -3)}}
                     </div>

                     <form method="POST" action="/archive/download">
                        @csrf
                        <input type="hidden" name="book_id" value="{{$book->id}}">
                        <button type="submit" class="primary-btn"><i class="fas fa-cloud-download-alt"></i> &nbsp;Скачать</button>
                     </form>
                  </div>
               @endforeach

               {{ $books->links()}}
            </div>

         @endif
      @endauth
</div>

@endsection