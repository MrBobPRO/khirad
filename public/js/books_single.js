 
//Escape more than one time form submit
if ($('#review_store')[0]) $('#review_store')[0].onsubmit = disableSubmitBtn1;
if ($('#add_into_basket')[0]) $('#add_into_basket')[0].onsubmit = disableSubmitBtn2;
if ($('#reviews_edit')[0]) $('#reviews_edit')[0].onsubmit = disableSubmitBtn3;
if ($('#remove_from_basket')[0]) $('#remove_from_basket')[0].onsubmit = disableSubmitBtn4;

function disableSubmitBtn1() {
  $('#review_store_btn').attr('disabled', true);
}
function disableSubmitBtn2() {
  $('#add_into_basket_btn').attr('disabled', true);
}
function disableSubmitBtn3() {
  $('#reviews_edit_btn').attr('disabled', true);
}
function disableSubmitBtn4() {
  $('#remove_from_basket_btn').attr('disabled', true);
}

// --------------------ADD REVIEW SCRIPT START--------------------------
//PREAPARE STARS ARRAY AND SET UP STARS ON CLICK AND ON HOVER FUNCTION
var add_review_stars = $('#add-review-stars > i');
for (var i = 0; i < add_review_stars.length; i++) {
  add_review_stars[i].onclick = on_add_review_stars_click;
  add_review_stars[i].onmouseover = on_add_review_stars_hover;
  add_review_stars[i].onmouseout = on_add_review_stars_mouseout;
}

//CANCEL ON HOVER FUCNTION CASE MARK ONCE ALREADY HAS BEEN SELECTED
var add_review_stars_already_selected = false;
//USED TO CHANGE VALUE ON STARS CLICK
var add_review_mark = $("input[name='mark']");


function on_add_review_stars_hover()
{
  //RETURN CASE ALREADY ONCE SELECTED
  if (add_review_stars_already_selected) return;
  //RESET SELECTED STARS 
  for (var i = 0; i < add_review_stars.length; i++)
    add_review_stars[i].className = 'far fa-star';
  // GET DATA-MARK OF STARS AND CHANGE STARS CLASS DUE TO IT
  for (var i = 0; i < this.dataset.mark; i++)
    add_review_stars[i].className = 'fas fa-star';
}

function on_add_review_stars_click()
{
  //RESET SELECTED STARS 
  for (var i = 0; i < add_review_stars.length; i++)
    add_review_stars[i].className = 'far fa-star';
  // GET DATA-MARK OF STARS AND CHANGE STARS CLASS DUE TO IT
  for (var i = 0; i < this.dataset.mark; i++)
    add_review_stars[i].className = 'fas fa-star';
  //CANCEL ON HOVER CASE ONCE SELECTED
  add_review_stars_already_selected = true;
  //CHANGE MARK INPUT VALUE INTO SELECTED STARS MARK
  add_review_mark.val(this.dataset.mark);
}

function on_add_review_stars_mouseout()
{
  // UNSELECT STARS CASE MARK DIDNT SELECTED YET
  if(!add_review_stars_already_selected)
    for (var i = 0; i < add_review_stars.length; i++)
    add_review_stars[i].className = 'far fa-star';
}
// --------------------ADD REVIEW SCRIPT END--------------------------



// --------------------EDIT REVIEW SCRIPT START--------------------------
//PREAPARE STARS ARRAY AND SET UP STARS ON CLICK AND ON HOVER FUNCTION
var edit_review_stars = $('#edit-review-stars > i');
for (var i = 0; i < edit_review_stars.length; i++) {
  edit_review_stars[i].onclick = on_edit_review_stars_click;
  edit_review_stars[i].onmouseover = on_edit_review_stars_hover;
  edit_review_stars[i].onmouseout = on_edit_review_stars_mouseout;
}

//CANCEL ON HOVER FUCNTION CASE MARK ONCE ALREADY HAS BEEN SELECTED
var edit_review_stars_already_selected = false;
//USED TO CHANGE VALUE ON STARS CLICK
var edit_review_mark = $("input[name='mark']");


function on_edit_review_stars_hover()
{
  //RETURN CASE ALREADY ONCE SELECTED
  if (edit_review_stars_already_selected) return;
  //RESET SELECTED STARS 
  for (var i = 0; i < edit_review_stars.length; i++)
    edit_review_stars[i].className = 'far fa-star';
  // GET DATA-MARK OF STARS AND CHANGE STARS CLASS DUE TO IT
  for (var i = 0; i < this.dataset.mark; i++)
    edit_review_stars[i].className = 'fas fa-star';
}

function on_edit_review_stars_click()
{
  //RESET SELECTED STARS 
  for (var i = 0; i < edit_review_stars.length; i++)
    edit_review_stars[i].className = 'far fa-star';
  // GET DATA-MARK OF STARS AND CHANGE STARS CLASS DUE TO IT
  for (var i = 0; i < this.dataset.mark; i++)
    edit_review_stars[i].className = 'fas fa-star';
  //CANCEL ON HOVER CASE ONCE SELECTED
  edit_review_stars_already_selected = true;
  //CHANGE MARK INPUT VALUE INTO SELECTED STARS MARK
  edit_review_mark.val(this.dataset.mark);
}

function on_edit_review_stars_mouseout()
{
  // UNSELECT STARS CASE MARK DIDNT SELECTED YET
  if(!edit_review_stars_already_selected)
    for (var i = 0; i < edit_review_stars.length; i++)
    edit_review_stars[i].className = 'far fa-star';
}
// --------------------EDIT REVIEW SCRIPT END--------------------------