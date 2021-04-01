
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

window.onload = function () {
   $('.jq-select').styler();  //JQ FORM STYLER
   $('#scrollTop')[0].onclick = scrollTop;

   // SET ON AJAX FUNCTIONS FOR AUTHENTICATION MODALS
   $('#loginBtn')[0].onclick = checkLogin;
   $('#registerBtn')[0].onclick = checkRegister;
};
   
// !!!!!!!!!!!!!!!MODAL ELEMENTS!!!!!!!!!!!!!!!!!!
//REGISTRATION INPUTS
let regName = $('#regName')[0];
let regEmail = $('#regEmail')[0];
let regPassword = $('#regPassword')[0];
let regPassConf = $('#password_confirmation')[0];
//FOR DEACTIVATING BUTTONS WHILE LOADING INFO
let loginBtn = $('#loginBtn')[0];
let registerBtn = $('#registerBtn')[0];
// SHOW SPINNERS WHILE LOADING INFO
let reg_spinner = $('#reg_spinner')[0];
let login_spinner = $('#login_spinner')[0];
// !!!!!!!!!!!!!!!MODAL ELEMENTS!!!!!!!!!!!!!!!!!!


// CHECK USER CREDENTIAL WHEN LOGGIN ON VIA MODAL
function checkLogin(e) {
   e.preventDefault();
   //SHOW SPINNER AND DISABLE BUTTON WHILE LOADING 
   login_spinner.style.display = 'inline-block';
   loginBtn.disabled = true;

   //REQUEST DATA FROM SERVER
   let email = $('#loginEmail')[0].value;
   let password = $('#loginPassword')[0].value;
   let remember_me = $('#remember_me')[0].checked;

   $.ajax({
      type:'POST',
      url:"/checkLogin",
      data:{email:email, password:password, remember:remember_me},
      success:function(data){
         applyLoginResults(data);
      }
   });

   // fetch('/checkLogin?email=' + email + '&password=' + password + '&remember=' + remember_me)
   //    .then(r => r.json())
   //    .then(applyLoginResults);

}

//SIGN IN USER AND RELOAD PAGE OR RETURN ERROR AFTER LOGIN SUBMIT
function applyLoginResults(result) {
   let loginError = $('#loginError')[0];

   if (result.status == 'success') {
      location.reload();
   } else {
      loginError.innerHTML = result.error;
   }

   // HIDE SPINNER AND ENABLE BUTTON AFTER REQUEST END
   login_spinner.style.display = 'none';
   loginBtn.disabled = false;
}

// CHECK USER CREDENTIAL WHEN REGISTERRING VIA MODAL
function checkRegister(e) {
   e.preventDefault();
   // SET INPUT BORDER COLORS AS INITIAL CASE MULTIPLE REGISTER TIME
   regName.style.borderColor = '#607d8b40';
   regEmail.style.borderColor = '#607d8b40';
   regPassword.style.borderColor = '#607d8b40';
   regPassConf.style.borderColor = '#607d8b40';

   //SHOW SPINNER AND DISABLE BUTTON WHILE LOADING 
   reg_spinner.style.display = 'inline-block';
   registerBtn.disabled = true;

   //REQUEST DATA FROM SERVER
   let name = regName.value;
   let email = regEmail.value;
   let password = regPassword.value;
   let password_confirmation = regPassConf.value;
   
   $.ajax({
      type:'POST',
      url:"/checkRegister",
      data:{name:name, email:email, password:password, pass_conf:password_confirmation},
      success:function(data){
         applyRegisterResults(data);
      }
   });

}

//REGISTER USER AND RELOAD PAGE OR RETURN ERROR AFTER REGISTER SUBMIT
function applyRegisterResults(result) {
   let registerError = $('#registerError')[0];

   if (result.status == 'success') {
      location.reload();
   } else {
      registerError.innerHTML = result.errorMsg;
      let result_errors = result.errors;

      // CHANGE INVALID INPUT COLORS INTO RED
      if (result_errors.includes('name')) regName.style.borderColor = 'red';
      if (result_errors.includes('emailFormat') || result_errors.includes('emailIsBusy')) regEmail.style.borderColor = 'red';
      if (result_errors.includes('passConf') || result_errors.includes('passLength')) {
         regPassword.style.borderColor = 'red';
         regPassConf.style.borderColor = 'red';
      } 
   } 

   // HIDE SPINNER AND ENABLE BUTTON AFTER REQUEST END
   reg_spinner.style.display = 'none';
   registerBtn.disabled = false;
}