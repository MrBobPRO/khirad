
@extends('webmaster.master')
@section('content')

<div class="content-info">
   <span><i class="fas fa-globe"></i>&nbsp; Количество заказов : <b>{{$ordersCount}}</b></span>
</div>

{{-- Categories seach start --}}
<div class="select2_single_container">
   <select class="select2_single select2_single_linked" data-placeholder="Найдите нужный заказ" data-dropdown-css-class="select2_single_dropdown">
      <option></option>
      @foreach($allOrders as $ord)
         <option value="{{ route('webmaster.orders.single', $ord->id)}}">{{$ord->name}}</option>   
      @endforeach
   </select>
</div>
{{-- Authors seach end --}}

<div class="list-titles">
   <div class="width-20">Заказчик</div>
   <div class="width-20">Номер телефона</div>
   <div class="width-20">Книга</div>
   <div class="width-20">Дата заказа</div>
   <div class="width-20">Статус</div>
</div>

@foreach ($orders as $order)
    <a class="list-item" href="{{route('webmaster.orders.single', $order->id)}}">
      <div class="width-20">{{$order->name}}</div>
      <div class="width-20">{{$order->phone}}</div>
      <div class="width-20">{{$order->book->name}}</div>
      <div class="width-20">
        <?php 
            $date = \Carbon\Carbon::parse($order->created_at)->locale('ru');
            $formatted = $date->isoFormat('DD MMMM YYYY H:mm:s');
        ?>
        {{$formatted}}
      </div>
      <div class="width-20">{!!$order->new ? '<span class="new">НОВЫЙ</span>' : 'ПРОСМОТРЕНО'!!}</div>
   </a>
@endforeach

{{$orders->links()}} 

@endsection
