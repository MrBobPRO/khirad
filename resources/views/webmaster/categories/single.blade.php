
@extends('webmaster.master')
@section('content')

<h3>{{$category->tjName}}</h3>

<form class="limited-width-form" action="/categories_update" method="POST">
   {{ csrf_field() }}

    <input name="id" type="hidden" value="{{$category->id}}">

   <div class="form-single-block">
      <label>Имя</label>
      <input name="tjName" type="text" value="{{$category->tjName}}" required>
   </div>

    <div class="form-single-block">
        <label>Имя на русском</label>
        <input name="ruName" type="text" value="{{$category->ruName}}" required>
    </div>  

   <button type="submit" class="primary-btn">Изменить категорию</button>
   
</form>

@endsection