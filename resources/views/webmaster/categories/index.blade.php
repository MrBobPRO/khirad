
@extends('webmaster.master')
@section('content')

<div class="content-info">
   <span><i class="fas fa-globe"></i>&nbsp; Количество категорий : <b>{{$categoriesCount}}</b></span>
   <span><i class="fas fa-plus"></i>&nbsp; <a href=" {{route('webmaster.categories.create')}} ">Добавить новую категорию</a></span>
</div>

{{-- Categories seach start --}}
<div class="select2_single_container">
   <select class="select2_single select2_single_linked" data-placeholder="Найдите нужную категорию" data-dropdown-css-class="select2_single_dropdown">
      <option></option>
      @foreach($categories as $category)
         <option value="{{ route('webmaster.categories.single', $category->id)}}">{{$category->name}}</option>   
      @endforeach
   </select>
</div>
{{-- Authors seach end --}}

<div class="list-titles">
   <div class="width-50">Название категории</div>
   <div class="width-50">Количество книг</div>
</div>

@foreach ($categories as $category)
    <a class="list-item" href="{{route('webmaster.categories.single', $category->id)}}">
      <div class="width-50">{{$category->name}}</div>
      <div class="width-50">{{count($category->books)}}</div>
   </a>
@endforeach

@endsection
