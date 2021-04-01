<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">{{ __('Войти') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="login-form" method="POST">
          
          <label for="loginEmail">{{ __('Электронная почта') }}</label>
          <input id="loginEmail" type="email" autofocus="autofocus">

          <label for="loginPassword">{{ __('Пароль') }}</label>
          <input id="loginPassword" type="password" autocomplete="current-password">

          <label for="remember_me" class="checkbox-label">{{ __('Запомнить меня') }}
            <input id="remember_me" type="checkbox"  name="remember" checked>
            <span class="checkmark"></span>
          </label>
        </form>

        <p id="loginError" class="modal-error"></p>
      </div>

      <div class="modal-footer">
        <div id="login_spinner" class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <button type="button" id="loginBtn" class=" primary-btn">{{ __('Войти') }}</button>
      </div>

    </div>
  </div>
</div>