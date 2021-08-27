
<div class="dashboard">
   <a class="dashboard-links" target="_blank" href="{{route('home')}}">
      <i class="fa fa-home"></i> Перейти на сайт
   </a>

   <a class="dashboard-links webmaster-profile" href="#">
      <i class="fas fa-user-circle"></i> Вэбмастер
   </a>

   <a class="dashboard-links @if($route == 'webmaster.index' || $route == 'webmaster.books.create' || $route == 'webmaster.books.errors' || $route == 'webmaster.books.single') active @endif"  href="{{route('webmaster.index')}}">
      <i class="fas fa-book"></i> Книги
   </a>

   <a class="dashboard-links @if($route == 'webmaster.authors.index' || $route == 'webmaster.authors.create' || $route == 'webmaster.authors.single') active @endif"  href="{{route('webmaster.authors.index')}}">
      <i class="fas fa-user-tie"></i> Авторы
   </a>

   <a class="dashboard-links @if($route == 'webmaster.categories.index' || $route == 'webmaster.categories.create' || $route == 'webmaster.categories.single') active @endif"  href="{{route('webmaster.categories.index')}}">
      <i class="fa fa-bahai"></i> Категории
   </a>

   <a class="dashboard-links @if($route == 'webmaster.reviews.index' || $route == 'webmaster.reviews.single') active @endif"  href="{{route('webmaster.reviews.index')}}">
      <i class="fa fa-star"></i> Отзывы
      @if($new_reviews_count > 0)
         ({{$new_reviews_count}})
      @endif
   </a>

   <a class="dashboard-links @if($route == 'webmaster.orders.index' || $route == 'webmaster.orders.single') active @endif"  href="{{route('webmaster.orders.index')}}">
      <i class="fa fa-wallet"></i> Заказы
      @if($new_orders_count > 0)
         ({{$new_orders_count}})
      @endif
   </a>

   <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"><i class="fas fa-sign-out-alt"></i> Выйти</button>
   </form>

</div>