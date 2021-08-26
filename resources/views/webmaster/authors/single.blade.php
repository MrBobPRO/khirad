
@extends('webmaster.master')
@section('content')

<h3>{{$author->name}}</h3>

<div class="content-info">
   <span><i class="fas fa-info-circle"></i>&nbsp; Очень важно чтобы картинки совпадали с нужными размерами, так как сайт будет подгонять их под себя!</span>
</div>

<form class="limited-width-form" action="/authors_update" method="POST" enctype="multipart/form-data">
   {{ csrf_field() }}

   <input type="hidden" name="id" value="{{$author->id}}">

   <div class="form-single-block">
      <label>Имя</label>
      <input name="name" type="text" value="{{$author->name}}" required>
   </div>

   <div class="form-single-block">
      <label>Национальность</label>
      <input class="wm-radio" type="radio" name="foreign" id="foreign_false" value="0" {{!$author->foreign ? 'checked' : ''}} />
      <label class="radio-labels mr-20px" for="foreign_false">Таджик</label>
      <input class="wm-radio" type="radio" name="foreign" id="foreign_true" value="1" {{$author->foreign ? 'checked' : ''}} />
      <label class="radio-labels" for="foreign_true">Зарубежный</label>
   </div>

   <div class="form-single-block">
      <label>Фото (файл). Необходимый размер 600x705 : {{$author->photo}}</label>
      <input name="photo" type="file" accept=".png, .jpeg, .jpg" class="upload-file" id="photo">
      <img class="form-img" src="{{asset('img/authors/' . $author->photo)}}">
   </div>

   <div class="form-single-block">
      <label>Биография</label>
      <textarea name="biography"  rows="7" required>{{$author->biography}}</textarea>
   </div>

   <div class="form-single-block">
      <label>Добавить к популярным авторам?</label>
      <input class="wm-radio" type="radio" name="popular" id="popular_true" value="1" {{$author->popular ? 'checked' : ''}}/>
      <label class="radio-labels mr-20px" for="popular_true">Да</label>
      <input class="wm-radio" type="radio" name="popular" id="popular_false" value="0" {{!$author->popular ? 'checked' : ''}}/>
      <label class="radio-labels" for="popular_false">Нет</label>
   </div>

   <div class="form-btns-container">
      <button type="submit" class="primary-btn">Сохранить изменения</button>
      <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="primary-btn secondary-btn">Удалить автора</button>
   </div>
   
</form>


<!-- Delete Modal start-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteModal">Удалить</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            При удалении автора также удалятся все его книги ! 
            <br>Вы уверены что хотите удалить текущего автора ?
            <br><br>Рекомендуется вручную удалить книги автора, и только потом самого автора !!!
         </div>
         <div class="modal-footer">
            <button type="button" class="primary-btn" data-bs-dismiss="modal">Отмена</button>

            <form action="/authors_remove" method="POST">
               {{ csrf_field() }}
               <input type="hidden" value="{{$author->id}}" name="id"/>
               <button type="submit" class="primary-btn secondary-btn">Удалить</button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Delete Modal end-->


@endsection