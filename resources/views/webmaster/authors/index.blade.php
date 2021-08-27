
@extends('webmaster.master')
@section('content')

<div class="content-info">
   <span><i class="fas fa-globe"></i>&nbsp; Количество авторов : <b>{{$authorsCount}}</b></span>
   <span><i class="fas fa-plus"></i>&nbsp; <a href=" {{route('webmaster.authors.create')}} ">Добавить нового автора</a></span>
</div>

{{-- Authors seach start --}}
<div class="select2_single_container">
   <select class="select2_single select2_single_linked" data-placeholder="Найдите нужного автора" data-dropdown-css-class="select2_single_dropdown">
      <option></option>
      @foreach($allAuthors as $author)
         <option value="{{ route('webmaster.authors.single', $author->id)}}">{{$author->name}}</option>   
      @endforeach
   </select>
</div>
{{-- Authors seach end --}}

<div class="list-titles">
   <div class="width-33">Имя автора</div>
   <div class="width-33">Национальность</div>
   <div class="width-33">Количество книг</div>
</div>

<form action="/authors_remove_multiple" method="POST" id="delete_multiple_items_form">
   @csrf

   @foreach ($authors as $author)
      <div class="list-item">
         {{-- checkboxes for multiple delete --}}
         <label for="{{$author->id}}" class="checkbox-label">
            <input id="{{$author->id}}" type="checkbox"  name="ids[]" value="{{$author->id}}">
            <span class="checkmark"></span>
         </label>
                  
         <div class="width-33">{{$author->name}}</div>
         <div class="width-33">{{$author->foreign ? 'Зарубежный' : 'Таджик'}}</div>
         <div class="width-33">{{count($author->books)}}</div>

         {{-- list item controls (delete and edit) --}}
         <div class="list-item-controls">
            <a href="{{route('webmaster.authors.single', $author->id)}}" title="Редактировать"><i class="fas fa-pen"></i></a>
            <button type="button" onclick="list_delete_button_click({{$author->id}})" title="Удалить"><i class="fas fa-trash"></i></button>
         </div>
      </div>
   @endforeach

   <button type="button" data-bs-toggle="modal" data-bs-target="#deleteMultipleModal" class="primary-btn mt-20px">Удалить отмеченные</button>
</form>


<!-- Delete Multiple Items Modal Start-->
<div class="modal fade" id="deleteMultipleModal" tabindex="-1" aria-labelledby="deleteMultipleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteMultipleModalLabel">Удалить</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">Вы уверены что хотите удалить отмеченные авторы?</div>
         <div class="modal-footer">
            <button type="button" class="primary-btn" data-bs-dismiss="modal">Отмена</button>
            <button type="button" class="primary-btn secondary-btn" id="modal_delete_multiple_button" 
               onclick="$('#modal_delete_multiple_button').attr('disabled', true);
               document.getElementById('delete_multiple_items_form').submit();"
               >Удалить
            </button>
         </div>
      </div>
   </div>
</div>
<!-- Delete Multiple Items Modal End-->


<!-- Delete Single Items Modal Start-->
<div class="modal fade" id="deleteSingleModal" tabindex="-1" aria-labelledby="deleteSingleModalLabel" aria-hidden="true">
   <div class="modal-dialog"> 
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="deleteSingleModalLabel">Удалить</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">Вы уверены что хотите удалить автора?</div>
         <div class="modal-footer">
            <button type="button" class="primary-btn" data-bs-dismiss="modal">Отмена</button>
            <form action="/authors_remove" method="POST" id="delete_single_item_form">
               {{ csrf_field() }}
               <input type="hidden" value="0" name="id" id="delete_single_item_input"/>
               <button type="submit" class="primary-btn secondary-btn" id="modal_delete_single_button">Удалить</button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Delete Single Items Modal End-->



{{$authors->links()}}

@endsection
