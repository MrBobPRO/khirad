
@extends('webmaster.master')
@section('content')

<h3>Добавить категорию</h3>

<div class="content-info">
    <span><i class="fas fa-info-circle"></i>
        Рекомендуется не добавлять слишком много категорий. Их и так очень много. <br>27 категорий самое подходящее количество !
    </span>
</div>

<form class="limited-width-form" action="/categories_store" method="POST">
   {{ csrf_field() }}

   <div class="form-single-block">
      <label>Имя</label>
      <input name="name" type="text" required>
   </div>

   <div class="form-single-block">
      <label>Описание</label>
      <textarea name="description" rows="7" required></textarea>
   </div>

   <button type="submit" class="primary-btn">Добавить категорию</button>
   
</form>

@endsection