
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
      <label>Картинка (файл). Необходимый размер 700x980</label>
      <input name="photo" type="file" accept=".png, .jpeg, .jpg" class="upload-file" id="photo" required>
   </div>

   <div class="form-single-block">
      <label>Категории</label>
      <div class="select2_multiple_container">
         <select name="categories" class="select2_multiple" data-dropdown-css-class="select2_multiple_dropdown" multiple required>
            @foreach ($categories as $category)
               <option value="{{$category->id}}">{{$category->tjName}}</option>
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
      <input class="wm-radio" type="radio" name="isFree" id="book_is_free" value="1"/>
      <label class="radio-labels mr-20px" for="book_is_free">Бесплатная</label>
      <input class="wm-radio" type="radio" name="isFree" id="book_isnt_free" value="0" checked/>
      <label class="radio-labels" for="book_isnt_free">Платная</label>
   </div>

   <div class="form-single-block" id="paid_books_inputs" data-form-action="create">
      {{-- <label>Цена (только цифры).</label>
      <input name="price" type="number" min="0" step="any" value="0" required>

      <label class="mt-20px">Скидочная цена (только цифры). Оставьте 0 если у книги нету скидочной цены!</label>
      <input name="discountPrice" type="number" min="0" step="any" value="0" required> --}}

      <label>Фрагмент книги для просмотра (файл)</label>
      <input name="piece" type="file" accept=".pdf" class="upload-file" id="piece" required>

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
      <label>Добавить книгу к популярным книгам?</label>
      <input class="wm-radio" type="radio" name="isPopular" id="book_is_popular" value="1"/>
      <label class="radio-labels mr-20px" for="book_is_popular">Да</label>
      <input class="wm-radio" type="radio" name="isPopular" id="book_isnt_popular" value="0" checked/>
      <label class="radio-labels" for="book_isnt_popular">Нет</label>
   </div>

   <div class="form-single-block" id="popular_books_inputs">
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