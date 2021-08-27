@extends('webmaster.master')
@section('content')

<h3>{{$book->name}}</h3>

<form onsubmit="ajax_books_store('/books_update')" class="limited-width-form" method="POST" enctype="multipart/form-data" id="store_book_form">
   {{ csrf_field() }}
   <input type="hidden" name="id" value="{{$book->id}}">

   <div class="form-single-block">
      <label>Название</label>
      <input name="name" type="text" value="{{$book->name}}" required>
   </div>

   <div class="form-single-block">
      <label>Авторы</label>
      <div class="select2_multiple_container">
         <select name="authors" class="select2_multiple" data-dropdown-css-class="select2_multiple_dropdown" multiple required>
            @foreach ($authors as $author)
            <option value="{{$author->id}}"
               @foreach ($book->authors as $bookAuthor)
                  {{ $bookAuthor->id == $author->id ? 'selected' : ''}}
               @endforeach
            >{{$author->name}}</option>
            @endforeach
         </select>
      </div>
   </div>

   <div class="form-single-block">
      <label>Книга (файл) : {{$book->filename == 'Ошибка' ? 'Пожалуйста выберите файл!!!' : $book->filename}}</label>
      <input name="book" type="file" accept=".pdf" class="upload-file" id="book">
   </div>

   <div class="form-single-block">
      <label>Язык</label>
      <input class="wm-radio" type="radio" name="language" id="lang_tj" value="tj" {{$book->language == 'tj' ? 'checked' : ''}} />
      <label class="radio-labels mr-20px" for="lang_tj">Таджикский</label>
      <input class="wm-radio" type="radio" name="language" id="lang_ru" value="ru" {{$book->language == 'ru' ? 'checked' : ''}} />
      <label class="radio-labels mr-20px" for="lang_ru">Русский</label>
      <input class="wm-radio" type="radio" name="language" id="lang_en" value="en" {{$book->language == 'en' ? 'checked' : ''}} />
      <label class="radio-labels" for="lang_en">Английский</label>
   </div>

   <div class="form-single-block">
      <label>Обложка книги (файл). Необходимый размер 700x980 : {{$book->photo == 'Ошибка' ? 'Пожалуйста выберите файл!!!' : $book->photo}}</label>
      <input name="photo" type="file" accept=".png, .jpeg, .jpg" class="upload-file" id="photo">
      <img class="form-img" src="{{asset('img/books/' . $book->photo)}}">
   </div>

   <div class="form-single-block">
      <label>Категории</label>
      <div class="select2_multiple_container">
         <select name="categories" class="select2_multiple" data-dropdown-css-class="select2_multiple_dropdown" multiple required>
            @foreach ($categories as $category)
               <option value="{{$category->id}}"
                  @foreach ($book->categories as $bookCategory)
                     {{ $bookCategory->id == $category->id ? 'selected' : ''}}
                  @endforeach
               >{{$category->name}}</option>
            @endforeach
         </select>
      </div>
   </div>

   <div class="form-single-block">
      <label>Описание</label>
      <textarea name="description"  rows="7" required>{{$book->description}}</textarea>
   </div>

   <div class="form-single-block">
      <label>Тип книги</label>
      <input class="wm-radio" type="radio" name="free" id="book_is_free" value="1" {{$book->free ? 'checked' : ''}} />
      <label class="radio-labels mr-20px" for="book_is_free">Бесплатная</label>
      <input class="wm-radio" type="radio" name="free" id="book_isnt_free" value="0" {{$book->free ? '' : 'checked'}} />
      <label class="radio-labels" for="book_isnt_free">Платная</label>
   </div>

   <div class="form-single-block" id="paid_books_inputs" @if(!$book->free) style="display: block" @endif>
      <label>Цена (только цифры).</label>
      <input name="price" id="price_input" type="number" value="{{$book->price}}" min="0" step="any" value="0" {{$book->free ? '' : 'required'}}>
   </div>

   <div class="form-single-block">
      <label class="mt-20px">Скриншот 1 : {{$book->screenshot1}}</label>
      <input name="screenshot1" type="file" accept=".png, .jpeg, .jpg" class="upload-file">
      @if($book->screenshot1 != '')
         <img class="form-img" src="{{asset('img/screenshots/' . $book->screenshot1)}}">
      @endif

      <label class="mt-20px">Скриншот 2 : {{$book->screenshot2}}</label>
      <input name="screenshot2" type="file" accept=".png, .jpeg, .jpg" class="upload-file">
      @if($book->screenshot2 != '')
         <img class="form-img" src="{{asset('img/screenshots/' . $book->screenshot2)}}">
      @endif

      <label class="mt-20px">Скриншот 3 : {{$book->screenshot3}}</label>
      <input name="screenshot3" type="file" accept=".png, .jpeg, .jpg" class="upload-file">
      @if($book->screenshot3 != '')
         <img class="form-img" src="{{asset('img/screenshots/' . $book->screenshot3)}}">
      @endif
   </div>

   <div class="form-single-block">
      <label>Издатель</label>
      <input name="publisher" value="{{$book->publisher}}" type="text" required>
   </div>

   <div class="form-single-block">
      <label>Год</label>
      <input name="year" type="number" value="{{$book->year}}" required>
   </div>

   <div class="form-single-block">
      <label>Количество страниц</label>
      <input name="pages" type="number" value="{{$book->pages}}" required>
   </div>

   <div class="form-single-block">
      <label>Добавить книгу в самые читаемые книги мира ?</label>
      <input class="wm-radio" type="radio" name="most_readable" id="book_is_most_readable" value="1" {{$book->most_readable ? 'checked' : ''}} />
      <label class="radio-labels mr-20px" for="book_is_most_readable">Да</label>
      <input class="wm-radio" type="radio" name="most_readable" id="book_isnt_most_readable" value="0" {{$book->most_readable ? '' : 'checked'}} />
      <label class="radio-labels" for="book_isnt_most_readable">Нет</label>
   </div>

   <div class="form-single-block" id="most_readable_books_inputs" @if($book->most_readable) style="display: block" @endif>
      <label>Цвет текста в слайдере популярных книг</label>
      <input name="txtColor" class="color-picker" value="{{$book->txtColor == '' ? 'black' : $book->txtColor}}">

      <label class="mt-20px">Цвет фона в слайдере популярных книг</label>
      <input name="bgColor" class="color-picker" value="{{$book->bgColor == '' ? '#F1EE9D' : $book->bgColor}}">

      <label class="mt-20px">Цвет текста кнопки в слайдере популярных книг</label>
      <input name="btnColor" class="color-picker" value="{{$book->btnColor == '' ? 'black' : $book->btnColor}}">
   </div>

   <div class="form-btns-container">
      <button type="submit" class="primary-btn">Сохранить изменения</button>
      <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="primary-btn secondary-btn">Удалить книгу</button>
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

            <form action="/books_remove" method="POST" id="modal_delete_form">
               {{ csrf_field() }}
               <input type="hidden" value="{{$book->id}}" name="id"/>
               <button type="submit" class="primary-btn secondary-btn" id="modal_delete_button">Удалить</button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Delete Modal end-->

@endsection