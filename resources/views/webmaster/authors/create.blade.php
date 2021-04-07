
@extends('webmaster.master')
@section('content')

<h3>Добавить автора</h3>

<div class="content-info">
   <span><i class="fas fa-info-circle"></i>&nbsp; Очень важно чтобы картинки совпадали с нужными размерами, так как сайт будет подгонять их под себя!</span>
</div>

<form class="limited-width-form" action="/authors_store" method="POST" enctype="multipart/form-data">
   {{ csrf_field() }}

   <div class="form-single-block">
      <label>Имя</label>
      <input name="name" type="text" required>
   </div>

   <div class="form-single-block">
      <label>Фото (файл)</label>
      <input name="photo" type="file" accept=".png, .jpeg, .jpg" class="upload-file" id="photo" required>
   </div>

   <div class="form-single-block">
      <label>Описание</label>
      <textarea name="description"  rows="7" required></textarea>
   </div>

   <div class="form-single-block">
      <label>Добавить к популярным авторам?</label>
      <input class="wm-radio" type="radio" name="isPopular" id="isPopular" value="1"/>
      <label class="radio-labels mr-20px" for="isPopular">Да</label>
      <input class="wm-radio" type="radio" name="isPopular" id="isntPopular" value="0" checked/>
      <label class="radio-labels" for="isntPopular">Нет</label>
   </div>

   <button type="submit" class="primary-btn">Добавить автора</button>
   
</form>

@endsection