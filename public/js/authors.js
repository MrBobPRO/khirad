
// SEARCH VARIBALES
var authors_list = $('.search-list')[0];
var authors_links = $('.search-list > a');
var authors_name_input = $("input[name='name']");

// SHOW AUTHORS LIST ON AUTHOR SEARCH INPUT FOCUS
function show_authors_list() {
   authors_list.style.visibility = 'visible';
}

// HIDE AUTHORS LIST ON AUTHOR SEARCH INPUT DISFOCUS
function hide_authors_list() {
   authors_list.style.visibility = 'hidden';
}

// HIDE AUTHOR NAMES WICH DONT MATCH WITH KEYWORD
function regenerate_authors_list() {
   //MATCH FUNCTION DOESNT WORK WITH STRING. SO USED REGEXP INSTEAD
   var regExp = new RegExp(authors_name_input.val(), 'i');

   for (var i = 0; i < authors_links.length; i++) {
      if (authors_links[i].innerHTML.match(regExp))
         authors_links[i].style.display = 'block';
      else 
         authors_links[i].style.display = 'none';
   }
}