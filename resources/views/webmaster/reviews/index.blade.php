
@extends('webmaster.master')
@section('content')

<div class="content-info">
   <span><i class="fas fa-globe"></i>&nbsp; Количество отзывов : <b>{{$reviewsCount}}</b></span>
</div>

{{-- Categories seach start --}}
<div class="select2_single_container">
   <select class="select2_single select2_single_linked" data-placeholder="Найдите нужный отзыв" data-dropdown-css-class="select2_single_dropdown">
      <option></option>
      @foreach($allReviews as $rev)
         <option value="{{ route('webmaster.reviews.single', $rev->id)}}">{{$rev->body}}</option>   
      @endforeach
   </select>
</div>
{{-- Authors seach end --}}

<div class="list-titles">
   <div class="width-20">Книга</div>
   <div class="width-20">Отзыв</div>
   <div class="width-20">Дата добавления</div>
   <div class="width-20">Статус</div>
   <div class="width-20">IP - адрес</div>
</div>

@foreach ($reviews as $review)
    <a class="list-item" href="{{route('webmaster.reviews.single', $review->id)}}">
      <div class="width-20">{{$review->book->name}}</div>
      <div class="width-20">{{$review->body}}</div>
      <div class="width-20">
        <?php 
            $date = \Carbon\Carbon::parse($review->created_at)->locale('ru');
            $formatted = $date->isoFormat('DD MMMM YYYY H:mm:s');
        ?>
        {{$formatted}}
      </div>
      <div class="width-20">{!!$review->new ? '<span class="new">НОВЫЙ</span>' : 'ПРОСМОТРЕНО'!!}</div>
      <div class="width-20">{{$review->ip}}</div>
   </a>
@endforeach

{{$reviews->links()}};

@endsection
