
//AJAX REQUEST SETUP
$.ajaxSetup({
   headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});


// SCROLL TOP BUTTON
function scrollTop() {
   let body = document.body;
   body.scrollIntoView({ block: 'start', behavior: 'smooth' });
}
$('#scrollTop')[0].onclick = scrollTop;

//------------------Search start---------------------------
var searchbar = document.getElementById('searchbar');
var search_input = document.getElementById('search_input');

function toogle_search() {
    searchbar.classList.toggle('show');
    search_input.focus();
}
//------------------Search end---------------------------
