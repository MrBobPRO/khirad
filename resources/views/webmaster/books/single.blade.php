

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
      <label>Картинка (файл). Необходимый размер 700x1030 : {{$book->photo == 'Ошибка' ? 'Пожалуйста выберите файл!!!' : $book->photo}}</label>
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
      <input class="wm-radio" type="radio" name="isFree" id="book_is_free" value="1"
         {{$book->isFree ? 'checked' : ''}}
      />
      <label class="radio-labels mr-20px" for="book_is_free">Бесплатная</label>
      <input class="wm-radio" type="radio" name="isFree" id="book_isnt_free" value="0"
         {{$book->isFree ? '' : 'checked'}}
      />
      <label class="radio-labels" for="book_isnt_free">Платная</label>
   </div>

   <div class="form-single-block" id="paid_books_inputs" @if($book->isFree) style="display: none" @endif>
      <label>Цена (только цифры).</label>
      <input name="price" type="number" min="0" step="any" value="{{$book->price}}" required>

      <label class="mt-20px">Скидочная цена (только цифры). Оставьте 0 если у книги нету скидочной цены!</label>
      <input name="discountPrice" type="number" min="0" step="any" value="{{$book->discountPrice}}" required>

      <label class="mt-20px">Скриншот 1 : {{$book->screenshot1}}</label>
      <input name="screenshot1" type="file" accept=".png, .jpeg, .jpg" class="upload-file">
      <img class="form-img" src="{{asset('img/screenshots/' . $book->screenshot1)}}">

      <label class="mt-20px">Скриншот 2 : {{$book->screenshot2}}</label>
      <input name="screenshot2" type="file" accept=".png, .jpeg, .jpg" class="upload-file">
      <img class="form-img" src="{{asset('img/screenshots/' . $book->screenshot2)}}">

      <label class="mt-20px">Скриншот 3 : {{$book->screenshot3}}</label>
      <input name="screenshot3" type="file" accept=".png, .jpeg, .jpg" class="upload-file">
      <img class="form-img" src="{{asset('img/screenshots/' . $book->screenshot3)}}">
   </div>

   <div class="form-single-block">
      <label>Издатель</label>
      <input name="publisher" type="text" value="{{$book->publisher}}" required>
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
      <label>Добавить книгу к популярным книгам?</label>
      <input class="wm-radio" type="radio" name="isPopular" id="book_is_popular" value="1"
         {{$book->isPopular ? 'checked' : ''}}
      />
      <label class="radio-labels mr-20px" for="book_is_popular">Да</label>
      <input class="wm-radio" type="radio" name="isPopular" id="book_isnt_popular" value="0"
         {{$book->isPopular ? '' : 'checked'}}
      />
      <label class="radio-labels" for="book_isnt_popular">Нет</label>
   </div>

   <div class="form-single-block" id="popular_books_inputs" @if($book->isPopular) style="display: block" @endif>
      <label>Цвет текста в слайдере популярных книг</label>
      <input name="txtColor" class="color-picker" value="{{$book->txtColor == '' ? 'black' : $book->txtColor}}">

      <label class="mt-20px">Цвет фона в слайдере популярных книг</label>
      <input name="bgColor" class="color-picker" value="{{$book->bgColor == '' ? '#F1EE9D' : $book->bgColor}}">

      <label class="mt-20px">Цвет текста кнопки в слайдере популярных книг</label>
      <input name="btnColor" class="color-picker" value="{{$book->btnColor == '' ? 'black' : $book->btnColor}}">
   </div>

   <button type="submit" class="primary-btn">Сохранить изменения</button>
   
</form>

@endsection