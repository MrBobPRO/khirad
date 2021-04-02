//Russian translations for select2 messages
$.fn.select2.amd.define('select2/i18n/ru',[],function () {
   return {
       errorLoading: function () {
           return 'Результат не может быть загружен.';
       },
       inputTooLong: function (args) {
           var overChars = args.input.length - args.maximum;
           var message = 'Пожалуйста, удалите ' + overChars + ' символ';
           if (overChars >= 2 && overChars <= 4) {
               message += 'а';
           } else if (overChars >= 5) {
               message += 'ов';
           }
           return message;
       },
       inputTooShort: function (args) {
           var remainingChars = args.minimum - args.input.length;

           var message = 'Пожалуйста, введите ' + remainingChars + ' или более символов';

           return message;
       },
       loadingMore: function () {
           return 'Загружаем ещё ресурсы…';
       },
       maximumSelected: function (args) {
           var message = 'Вы можете выбрать ' + args.maximum + ' элемент';

           if (args.maximum  >= 2 && args.maximum <= 4) {
               message += 'а';
           } else if (args.maximum >= 5) {
               message += 'ов';
           }

           return message;
       },
       noResults: function () {
         return 'Ничего не найдено';
       },
       searching: function () {
         return 'Поиск…';
       }
   };
});

$(document).ready(function () {
   //Select2
   $('.select2_single').select2(
      {
         allowClear: true,
         language: 'ru'
      }
   );  

   //MultiSelect2
   $('.select2_multiple').select2(
      {
         closeOnSelect: false,
         language: 'ru',
         width: '100%'
         // tags: true, means that user can create new option
         // tokenSeparators: [',', ' '], Automatic tokenization into tags
      }
   );   
});

//Chaange search placeholder on select2 show and focus on it
$('.select2_single').on('select2:open', function (e) {
   $('.select2-search__field')[0].placeholder = 'Поиск...';
   $('.select2-search__field')[0].focus();
});
//Change clear buttons title on select2 single select
$('.select2_single').on('select2:select', function (e) {
   $('.select2-selection__clear')[0].title = 'Очистить';
});
//Change clear buttons title on select2 multiselect
$('.select2_multiple').on('select2:select', function (e) {
   var btns = $('.select2-selection__choice__remove');
   for (var i = 0; i < btns.length; i++) {
      btns[i].title = 'Очистить';
   }
});

//----------------Linked Select2--------------------------
//Change window url on linked selects
$('.select2_single_linked').on('select2:select', function (e) {
   window.location = e.params.data.id;
});
//----------------Linked Select2--------------------------

//global variables
var popular_books_inputs = document.getElementById('popular_books_inputs');
var paid_books_inputs = document.getElementById('paid_books_inputs');
var spinner = document.getElementById('spinner-container');

window.onload = function () {
   $('.wm-select').styler(); //JQ FORM STYLER
   $('.wm-radio').styler(); //JQ Radio
   $('.upload-file').styler(); //JQ FORM STYLER

   //Color Picker
   $('.color-picker').spectrum({
      type: "component"
    });
   
};

//-----------------On RadioButton Changes---------------------
//Show or hide aaditional inputs On Popular Book answer change
$('#book_is_popular').on('change', function () {
   if ($(this).is(':checked')) {
      popular_books_inputs.style.display = 'block';
   }
});

$('#book_isnt_popular').on('change', function () {
   if ($(this).is(':checked')) {
      popular_books_inputs.style.display = 'none';
   }
});

//Show or hide aaditional inputs On Free/Paid Books answer change
$('#book_is_free').on('change', function () {
   if ($(this).is(':checked')) {
      paid_books_inputs.style.display = 'none';
   }
});

$('#book_isnt_free').on('change', function () {
   if ($(this).is(':checked')) {
      paid_books_inputs.style.display = 'block';
   }
});
//-----------------On RadioButton Changes---------------------


//Ajax request setup
$.ajaxSetup({
   headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

//Preapare and send data to the server on form submit (Used for books store & update requests)
function ajax_books_store(post_url) {
   event.preventDefault();

   //display file sizes if inputs contain files
   var file1 = document.getElementById('book').files[0];
   if (file1) {
      document.getElementById('spinner_file1').innerHTML = 'Размер книги: ' + (file1.size/1024/1024).toFixed(2) + ' мг. ' 
   }

   var file2 = document.getElementById('photo').files[0];
   if (file2) {
      document.getElementById('spinner_file2').innerHTML = 'Размер картинки: ' + (file2.size/1024/1024).toFixed(2) + ' мг. ' 
   }

   //show spinner until success function
   spinner.style.visibility = 'visible';

   //generate new FormData object
   var form = $('#store_book_form')[0];
   var data = new FormData(form);

   //add encoded JSON arrays into FormData because FormData doesnt support arrays   
   var auths = $("select[name=authors]").val();
   var encodedAuthors = JSON.stringify(auths);
   data.append('encodedAuthors', encodedAuthors);

   var cats = $("select[name=categories]").val();
   var encodedCategories = JSON.stringify(cats);
   data.append('encodedCategories', encodedCategories);

   //send ajax request
   $.ajax({
      type: 'POST',
      enctype: 'multipart/form-data',
      url: post_url,
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      //reload page on success
      success: function (url) {
         //redirect to webmaster.home if its books_store method
         if (post_url == '/books_store') location.replace(url);
         else location.reload();
      },
      error: function () {
         alert('Упс, что-то пошло не так. Проверьте список ошибочных книг!');
         location.reload();
      }
   });
}