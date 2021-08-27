
@extends('webmaster.master')
@section('content')

<h3>Заказчик : {{$order->name}}</h3>

<form class="limited-width-form" action="#" method="POST">
   {{ csrf_field() }}

   <div class="form-single-block">
      <label>Заказчик</label>
      <input type="text" value="{{$order->name}}" readonly>
   </div>

   <div class="form-single-block">
      <label>Телефон</label>
      <input type="text" value="{{$order->phone}}" readonly>
   </div>

   <div class="form-single-block">
      <label>Заказал книгу</label>
      <input type="text" value="{{$order->book->name}}" readonly>
   </div>

   <div class="form-single-block">
      <label>Дата заказа</label>
      <?php 
         $date = \Carbon\Carbon::parse($order->created_at)->locale('ru');
         $formatted = $date->isoFormat('DD MMMM YYYY H:mm:s');
      ?>
      <input type="text" value="{{$formatted}}" readonly>
   </div>

    <div class="form-single-block">
        <label>IP - адрес заказчика</label>
        <input type="text" value="{{$order->ip}}" readonly>
    </div>

   <div class="form-btns-container">
      <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="primary-btn secondary-btn">Удалить отзыв</button>
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
          <div class="modal-body">Вы уверены что хотите удалить?</div>
          <div class="modal-footer">
             <button type="button" class="primary-btn" data-bs-dismiss="modal">Отмена</button>
 
             <form action="/orders_remove" method="POST" id="modal_delete_form">
                {{ csrf_field() }}
                <input type="hidden" value="{{$order->id}}" name="id"/>
                <button type="submit" class="primary-btn secondary-btn" id="modal_delete_button">Удалить</button>
             </form>
          </div>
       </div>
    </div>
 </div>
 <!-- Delete Modal end-->


@endsection