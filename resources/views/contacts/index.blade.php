
@extends('templates.master')
@section('content')

<div class="primary-container contacts-container">
   <h1>Ба мо нависед</h1>

   <div class="contacts-inner-div">
      <form action="/email" method="POST" class="contacts-form">
         <div class="double-input">
            <input type="text" name="name" placeholder="Номи Шумо">
            <input type="text" name="email" placeholder="Почта*">
         </div>

         <input type="text" name="theme" placeholder="Мавзуъ">
         <textarea name="message" rows="8" placeholder="Матн*"></textarea>
         <button type="submit" class="primary-btn primary-btn-shadow">Фиристодан</button>
      </form>

      <div id="map"></div>
   </div>
</div>

@endsection