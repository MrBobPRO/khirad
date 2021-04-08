<div class="navbar-container">
   <div class="primary-container">

      {{-- TOP NAVBAR START --}}
      <div class="navbar-top">
         @auth
         <div class="nav-top-left">
            <div class="user-profile">
               <div><img src="{{asset('img/main/avatar.png')}}"> {{auth()->user()->name}}</div>
               <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <span> / </span>
                  <button type="submit">{{ __('Выйти') }}</button>
               </form>
            </div>

         </div>
         @endauth

         @guest
         <div class="nav-top-left">
            <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
               {{ __("Войти") }}
            </button>
            <span> / </span>
            <button type="button" data-bs-toggle="modal" data-bs-target="#registerModal">
               {{ __("Регистрация") }}
            </button>
         </div>
         @endguest

         <div class="nav-top-middle">
            <form action="/search" method="GET">
               {{-- global seach start --}}
               <div class="select2_single_container navbar_search_container">
                  <select class="select2_single navbar_select2_single" data-placeholder="{{ __('Поиск всех наших книг...') }}" data-dropdown-css-class="select2_single_dropdown select2_navbar_dropdown" name="keyword">
                     <option></option>
                     @foreach($allBooksNames as $name)
                        <option value="{{$name}}">{{$name}}</option>   
                     @endforeach
                     @foreach($allAuthorsNames as $name)
                        <option value="{{$name}}">{{$name}}</option>   
                     @endforeach
                  </select>
                  <button class="primary-btn" type="submit">{{ __("Поиск") }}</button>
               </div>
               {{-- global seach end --}}
            </form> 
         </div>

         <div class="nav-top-right">
            <div class="nav-bookshelf">
               <img src="{{asset('img/main/bookShelf.png')}}">
               <div>
                  <a href="{{route('archive')}}">{{ __("Архив") }}</a>
                  <p>
                     @auth {{\Auth::user()->books->count()}} @endauth
                     @guest 0 @endguest
                     книг
                  </p>
               </div>
            </div>

            <div class="nav-basket">
               <img src="{{asset('img/main/basket.png')}}">
               <div>
                  <a href="{{route('basket')}}">{{ __("Корзина") }}</a>
                  {{-- CHECK IF USER HAS AUTH --}}
                  @if(\Auth::check())
                     {{-- CHECK IF USERS BASKET IS EMPTY --}}
                     @if(\Auth::user()->basket->count() == 0)
                        <p>0.00 сомони</p>
                     @else 
                        <?php 
                           $totalPrice = 0;
                           foreach(\Auth::user()->basket as $book)
                              // CHECK IF BOOK HAS DISCOUNTED PRICE AND GENERATE TOTAL PRICE 
                              $book->discountPrice != 0 ? $totalPrice += $book->discountPrice : $totalPrice += $book->price;
                        ?>
                        <p>{{$totalPrice . ' сом'}}</p>
                     @endif
                  {{-- ELSE IF USER IS GUEST   --}}
                  @else
                     <p>0.00 сомони</p>
                  @endif
               </div>
            </div>
         </div>

      </div>
      {{-- TOP NAVBAR END --}}

      {{-- BOTTOM NAVBAR START --}}
      <div class="navbar-bottom">
         <a href="/"><img src="{{asset('img/main/logo-nav.png')}}"></a>


         {{-- BOTTOM NAVBAR MENU START --}}
         <div class="navbar-bottom-menu">
            <a class="nav-btm-links" href="/">{{ __("Главная") }}</a>
      
            <div class="category-mega-menu">
               <a class="mega-menu-toogler" href="#">{{ __("Категории") }} <i></i></a>
               <div class="mega-menu-content">

                  <div class="mega-menu-left">
                     <h2>{{ __("Дополнительно") }}</h2>
                     <a href="{{route('books.all')}}">{{ __("Все книги") }}</a>
                     <a href="{{route('categories.bestsellers')}}">{{ __("Бестселлеры") }}</a>
                     <a href="{{route('categories.rating')}}">{{ __("Книги с высокими рейтингами") }}</a>
                     <a href="{{route('categories.popular')}}">{{ __("Популярные книги") }}</a>
                     <a href="{{route('authors.popular')}}">{{ __("Популярные авторы") }}</a>
                     <a href="{{route('categories.discounts')}}">{{ __("Актуальные скидки") }}</a>
                     <div class="nav-seperator"></div>
                     <a href="{{route('questions')}}">{{ __("Вопрос - ответ") }}</a>
                  </div>
      
                  <div class="mega-menu-right">
                     <h2>{{ __("Категории") }}</h2>
                     <div class="mega-menu-right-inner">
                        {{-- $navCats DEFINED ON APPSERVICEPROVIDER --}}
                        @foreach($navCats as $category)
                           <a href="{{route('categories.single', $category->id)}}">{{$curLocale == 'tj' ? $category->name : $category->russian_name}}</a>
                        @endforeach
                     </div>
                  </div>

               </div>
            </div>
      
            <a class="nav-btm-links" href="{{route('categories.free')}}">{{ __("Онлайн читалка") }}</a>
            <a class="nav-btm-links" href="{{route('authors')}}">{{ __("Авторы") }}</a>
            {{-- <a class="nav-btm-links" href="{{route('questions')}}">Вопрос - ответ</a> --}}
            <a class="nav-btm-links" href="{{route('contacts')}}">{{ __("Контакты") }}</a>
      
            <div class="dropdown nav-lang-dropdown">
               <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                  @if($curLocale == 'ru')
                     <img src="{{asset('img/main/russian.png')}}"> Русский
                  @else
                     <img src="{{asset('img/main/tajik.png')}}"> Тоҷикӣ
                  @endif
               </button>
               <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
      
                  @if($curLocale == 'ru')
               <li>
                     <form action="/setLangRu" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><img src="{{asset('img/main/russian.png')}}"> Русский</button>
                     </form>
                  </li>
                  
                  <li>
                     <form action="/setLangTj" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><img src="{{asset('img/main/tajik.png')}}"> Тоҷикӣ</button>
                     </form>
                  </li>
      
                  @else
                  <li>
                     <form action="/setLangTj" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><img src="{{asset('img/main/tajik.png')}}"> Тоҷикӣ</button>
                     </form>
                  </li>
      
                  <li>
                     <form action="/setLangRu" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><img src="{{asset('img/main/russian.png')}}"> Русский</button>
                     </form>
                  </li>
                  @endif
               </ul>
            </div>
         </div>  {{-- Bottom NAVBAR MENU END --}}

      </div>   {{-- BOTTOM NAVBAR END --}}
   </div> {{-- PRIMARY CONTAINER END --}}
</div> {{-- NAVBAR CONTAINER END --}}



