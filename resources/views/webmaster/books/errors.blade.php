
@extends('webmaster.master')
@section('content')

<div class="content-info">
	<span>
		Здесь будут хранятся книги, у которых возникли ошибки при их загрузке на сайт.
		<br>Пожалуйста исправьте ошибки!
		<br><br><i class="fas fa-info-circle"></i>&nbsp; Всего <b>{{count($books)}}</b> повреждённых книг
	</span>
</div>

<div class="list-titles">
   <div class="width-33">Название</div>
   <div class="width-33">Автор</div>
   <div class="width-33">Дата добавления</div>
</div>

@foreach ($books as $book)
    <a class="list-item" href="{{route('webmaster.books.single', $book->id)}}">
      <div class="width-33">{{$book->name}}</div>
      <div class="width-33">
         @foreach ($book->authors as $author)
             {{$author->name . ' '}}
         @endforeach
      </div>
      <div class="width-33" style="text-transform: capitalize">
         <?php $date = \Carbon\Carbon::parse($book->created_at)->locale('ru');
         $formatted = $date->isoFormat('DD MMMM YYYY') ?>
         {{$formatted}}
      </div>

      @if($book->isPopular)
         <span class="list-items-tag">Популярный</span>
      @endif
   </a>
@endforeach

@endsection
