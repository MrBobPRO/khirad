<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">{{ __('Регистрация') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="register-form" method="POST">

          <label for="regName">{{ __('Имя') }}</label>
          <input id="regName" type="text" autofocus="autofocus">

          <label for="regEmail">{{ __('Электронная почта') }}</label>
          <input id="regEmail" type="email" autofocus="autofocus">

          <label for="regPassword">{{ __('Пароль') }}</label>
          <input id="regPassword" type="password">

          <label for="password_confirmation">{{ __('Подтвердите пароль') }}</label>
          <input id="password_confirmation" type="password">
        </form>

        <p id="registerError" class="modal-error"></p>
      </div>

      <div class="modal-footer">
        <div id="reg_spinner" class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <button id="registerBtn" type="button" class=" primary-btn">{{ __('Регистрация') }}</button>
      </div>

    </div>
  </div>
</div>