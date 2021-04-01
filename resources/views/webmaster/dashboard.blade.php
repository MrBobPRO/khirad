
<div class="dashboard">
   <a class="dashboard-links" target="_blank" href="{{route('home')}}">
      <i class="fa fa-home"></i> Перейти на сайт
   </a>

   <a class="dashboard-links webmaster-profile" href="#">
      <i class="fas fa-user-circle"></i> Вэбмастер
   </a>

   <a class="dashboard-links @if($route == 'webmaster.index' || $route == 'webmaster.books.create' || $route == 'webmaster.books.single') active @endif"  href="{{route('webmaster.index')}}">
      <i class="fas fa-book"></i> Книги</h5>
   </a>

   <a class="dashboard-links @if($route == 'webmaster.authors') active @endif"  href="{{route('webmaster.index')}}">
      <i class="fas fa-user-tie"></i> Авторы</h5>
   </a>

   <a class="dashboard-links @if($route == 'webmaster.categories') active @endif"  href="{{route('webmaster.index')}}">
      <i class="fa fa-star"></i> Категории</h5>
   </a>

   <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"><i class="fas fa-sign-out-alt"></i> Выйти</button>
   </form>

</div>