
@extends('webmaster.master')
@section('content')

<div class="content-info">
   <span><i class="fas fa-globe"></i>&nbsp; Количество авторов : <b>{{$authorsCount}}</b></span>
   <span><i class="fas fa-plus"></i>&nbsp; <a href=" {{route('webmaster.authors.create')}} ">Добавить нового автора</a></span>
</div>

{{-- Authors seach start --}}
<div class="select2_single_container">
   <select class="select2_single select2_single_linked" data-placeholder="Найдите нужного автора" data-dropdown-css-class="select2_single_dropdown">
      <option></option>
      @foreach($allAuthors as $author)
         <option value="{{ route('webmaster.authors.single', $author->id)}}">{{$author->name}}</option>   
      @endforeach
   </select>
</div>
{{-- Authors seach end --}}

<div class="list-titles">
   <div class="width-50">Имя автора</div>
   <div class="width-50">Количество книг</div>
</div>

@foreach ($authors as $author)
    <a class="list-item" href="{{route('webmaster.authors.single', $author->id)}}">
      <div class="width-50">{{$author->name}}</div>
      <div class="width-50">{{count($author->books)}}</div>
      @if($author->isPopular)
         <span class="list-items-tag">Популярный</span>
      @endif
   </a>
@endforeach

{{$authors->links()}}

@endsection
