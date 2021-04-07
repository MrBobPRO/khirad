
@extends('webmaster.master')
@section('content')

<h3>{{$category->name}}</h3>

<form class="limited-width-form" action="/categories_update" method="POST">
   {{ csrf_field() }}

    <input name="id" type="hidden" value="{{$category->id}}">

   <div class="form-single-block">
      <label>Имя</label>
      <input name="name" type="text" value="{{$category->name}}" required>
   </div>

    <div class="form-single-block">
        <label>Имя на русском</label>
        <input name="russian_name" type="text" value="{{$category->russian_name}}" required>
    </div>  

   <button type="submit" class="primary-btn">Изменить категорию</button>
   
</form>

@endsection