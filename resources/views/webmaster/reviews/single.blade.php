
@extends('webmaster.master')
@section('content')

<h3>Автор : {{$review->user_name}}</h3>

<form class="limited-width-form" action="#" method="POST">
   {{ csrf_field() }}

   <div class="form-single-block">
      <label>Автор</label>
      <input type="text" value="{{$review->user_name}}" readonly>
   </div>

   <div class="form-single-block">
        <label>Оценка</label>
        @include('marks.' . $review->mark)
    </div>

   <div class="form-single-block">
      <label>Текст</label>
      <textarea rows="5" readonly>{{$review->body}}</textarea>
   </div>

   <div class="form-single-block">
        <label>Книга</label>
        <input type="text" value="{{$review->book->name}}" readonly>
    </div>

    <div class="form-single-block">
      <label>Дата добавления</label>
      <?php 
         $date = \Carbon\Carbon::parse($review->created_at)->locale('ru');
         $formatted = $date->isoFormat('DD MMMM YYYY H:mm:s');
      ?>
      <input type="text" value="{{$formatted}}" readonly>
   </div>

    <div class="form-single-block">
        <label>IP - адрес автора</label>
        <input type="text" value="{{$review->ip}}" readonly>
    </div>

    <div class="form-btns-container">
        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="primary-btn secondary-btn">Удалить отзыв</button>
     </div>
   
</form>


<!-- Delete Modal start-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="deleteModalLabel">Удалить</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">Вы уверены что хотите удалить?</div>
          <div class="modal-footer">
             <button type="button" class="primary-btn" data-bs-dismiss="modal">Отмена</button>
 
             <form action="/reviews_remove" method="POST" id="modal_delete_form">
                {{ csrf_field() }}
                <input type="hidden" value="{{$review->id}}" name="id"/>
                <button type="submit" class="primary-btn secondary-btn" id="modal_delete_button">Удалить</button>
             </form>
          </div>
       </div>
    </div>
 </div>
 <!-- Delete Modal end-->


@endsection