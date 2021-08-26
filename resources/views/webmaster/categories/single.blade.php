
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
      <label>Описание</label>
      <textarea name="description" rows="7" required>{{$category->description}}</textarea>
   </div>

   <button type="submit" class="primary-btn">Сохранить изменения</button>
   
</form>

@endsection