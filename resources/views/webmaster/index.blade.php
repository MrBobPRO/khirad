
@extends('webmaster.master')
@section('content')

<div class="content-info">
   <span><i class="fas fa-globe"></i>&nbsp; Всего <b>{{$booksCount}}</b> книг</span>
   <span><i class="fas fa-plus"></i>&nbsp; <a href=" {{route('webmaster.books.create')}} ">Добавить новую книгу</a></span>
   <span><i class="fas fa-exclamation-triangle"></i>&nbsp; <a href=" {{route('webmaster.books.errors')}} ">Ошибки <b>({{$erroredBooks}})</b></a></span>
</div>

{{-- Books seach start --}}
<div class="select2_single_container">
   <select class="select2_single" data-placeholder="Найдите нужную книгу" data-dropdown-css-class="select2_single_dropdown">
      <option></option>
      @foreach($allBooks as $book)
         <option value="{{ route('webmaster.books.single', $book->id)}}">{{$book->name}}</option>   
      @endforeach
   </select>
</div>
{{-- Books seach end --}}

<div class="list-titles">
   <div class="width-25">Название</div>
   <div class="width-25">Автор</div>
   <div class="width-25">Дата добавления</div>
   <div class="width-25">Цена</div>
   {{-- <div class="width-20">Количество покупок</div> --}}
</div>

@foreach ($books as $book)
    <a class="list-item" href="{{route('webmaster.books.single', $book->id)}}">
      <div class="width-25">{{$book->name}}</div>
      <div class="width-25">
         @foreach ($book->authors as $author)
             {{$author->name . ' '}}
         @endforeach
      </div>
      <div class="width-25" style="text-transform: capitalize">
         <?php $date = \Carbon\Carbon::parse($book->created_at)->locale('ru');
         $formatted = $date->isoFormat('DD MMMM YYYY') ?>
         {{$formatted}}
      </div>
      <div class="width-25">
         @if($book->isFree) <span class="free">Бесплатная</span>
         {{-- @elseif($book->discountPrice != 0) {{$book->discountPrice}} сом  --}}
         {{-- @else{{$book->price}} сом --}}
         @else Платная
         @endif
      </div>
      {{-- <div class="width-20">{{$book->isFree ? '' : $book->sales}}</div> --}}

      @if($book->isPopular)
         <span class="list-items-tag">Популярный</span>
      @endif
   </a>
@endforeach

{{$books->links()}}

@endsection
