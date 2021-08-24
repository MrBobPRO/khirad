
@extends('webmaster.master')
@section('content')

<h3>Добавить новую книгу</h3>

<div class="content-info">
   <span><i class="fas fa-info-circle"></i>&nbsp; Очень важно чтобы картинки совпадали с нужными размерами, так как сайт будет подгонять их под себя!</span>
</div>

<form onsubmit="ajax_books_store('/books_store')" class="limited-width-form" method="POST" enctype="multipart/form-data" id="store_book_form">
   {{ csrf_field() }}

   <div class="form-single-block">
      <label>Название</label>
      <input name="name" type="text" required>
   </div>

   <div class="form-single-block">
      <label>Авторы</label>
      <div class="select2_multiple_container">
         <select name="authors" class="select2_multiple" data-dropdown-css-class="select2_multiple_dropdown" multiple required>
            @foreach ($authors as $author)
               <option value="{{$author->id}}">{{$author->name}}</option>
            @endforeach
         </select>
      </div>
   </div>

   <div class="form-single-block">
      <label>Книга (файл)</label>
      <input name="book" type="file" accept=".pdf" class="upload-file" id="book" required>
   </div>

   <div class="form-single-block">
      <label>Язык</label>
      <input class="wm-radio" type="radio" name="language" id="lang_tj" value="tj" checked />
      <label class="radio-labels mr-20px" for="lang_tj">Таджикский</label>
      <input class="wm-radio" type="radio" name="language" id="lang_ru" value="ru" />
      <label class="radio-labels mr-20px" for="lang_ru">Русский</label>
      <input class="wm-radio" type="radio" name="language" id="lang_en" value="en" />
      <label class="radio-labels" for="lang_en">Английский</label>
   </div>

   <div class="form-single-block">
      <label>Обложка книги (файл). Необходимый размер 700x980</label>
      <input name="photo" type="file" accept=".png, .jpeg, .jpg" class="upload-file" id="photo" required>
   </div>

   <div class="form-single-block">
      <label>Категории</label>
      <div class="select2_multiple_container">
         <select name="categories" class="select2_multiple" data-dropdown-css-class="select2_multiple_dropdown" multiple required>
            @foreach ($categories as $category)
               <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
         </select>
      </div>
   </div>

   <div class="form-single-block">
      <label>Описание</label>
      <textarea name="description"  rows="7" required></textarea>
   </div>

   <div class="form-single-block">
      <label>Тип книги</label>
      <input class="wm-radio" type="radio" name="free" id="book_is_free" value="1" checked />
      <label class="radio-labels mr-20px" for="book_is_free">Бесплатная</label>
      <input class="wm-radio" type="radio" name="free" id="book_isnt_free" value="0"/>
      <label class="radio-labels" for="book_isnt_free">Платная</label>
   </div>

   <div class="form-single-block" id="paid_books_inputs">
      <label>Цена (только цифры).</label>
      <input name="price" id="price_input" type="number" min="0" step="any" value="0">
   </div>

   <div class="form-single-block">
      <label class="mt-20px">Скриншот 1. Все 3 скриншота должны иметь одинаковые размеры!</label>
      <input name="screenshot1" type="file" accept=".png, .jpeg, .jpg" class="upload-file">

      <label class="mt-20px">Скриншот 2</label>
      <input name="screenshot2" type="file" accept=".png, .jpeg, .jpg" class="upload-file">

      <label class="mt-20px">Скриншот 3</label>
      <input name="screenshot3" type="file" accept=".png, .jpeg, .jpg" class="upload-file">
   </div>

   <div class="form-single-block">
      <label>Издатель</label>
      <input name="publisher" type="text" required>
   </div>

   <div class="form-single-block">
      <label>Год</label>
      <input name="year" type="number" required>
   </div>

   <div class="form-single-block">
      <label>Количество страниц</label>
      <input name="pages" type="number" required>
   </div>

   <div class="form-single-block">
      <label>Добавить книгу в самые читаемые книги мира ?</label>
      <input class="wm-radio" type="radio" name="most_readable" id="book_is_most_readable" value="1"/>
      <label class="radio-labels mr-20px" for="book_is_most_readable">Да</label>
      <input class="wm-radio" type="radio" name="most_readable" id="book_isnt_most_readable" value="0" checked/>
      <label class="radio-labels" for="book_isnt_most_readable">Нет</label>
   </div>

   <div class="form-single-block" id="most_readable_books_inputs">
      <label>Цвет текста в слайдере популярных книг</label>
      <input name="txtColor" class="color-picker" value="black">

      <label class="mt-20px">Цвет фона в слайдере популярных книг</label>
      <input name="bgColor" class="color-picker" value="#F1EE9D">

      <label class="mt-20px">Цвет текста кнопки в слайдере популярных книг</label>
      <input name="btnColor" class="color-picker" value="black">
   </div>

   <button type="submit" class="primary-btn">Добавить книгу</button>
   
</form>

@endsection