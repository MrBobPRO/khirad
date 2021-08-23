<header>
   <nav class="primary-container main-navbar">
      <a href="/" class="nav-logo"><img src="{{asset('img/main/logo-nav.png')}}" alt="Хирад лого"></a>

      {{-- Navbar links start --}}
      <div class="nav-links-container">
         <a class="nav-links" href="/">Асосӣ</a>
      
         {{-- Category mega menu start --}}
         <div class="category-mega-menu">
            <a class="mega-menu-toogler" href="#">Дастабандӣ <i></i></a>
            <div class="mega-menu-content">

               <div class="mega-menu-left">
                  <h2>Илова бар ин</h2>
                  <a href="{{route('books.all')}}">Ҳамаи китобҳо</a>
                  <a href="{{route('categories.rating')}}">Китобҳои дорои баҳои баланд</a>
                  <a href="{{route('categories.world_most_readable')}}">Серхондатарин китобҳои ҷаҳон</a>
                  <a href="{{route('categories.site_most_readable')}}">Серхондатарин китобҳои сомона</a>
                  <a href="{{route('authors.popular')}}">Муаллифони машҳур</a>
                  <div class="nav-seperator"></div>
                  <a href="{{route('questions')}}">Савол - ҷавоб</a>
               </div>
   
               <div class="mega-menu-right">
                  <h2>Дастабандӣ</h2>
                  <div class="mega-menu-right-inner">
                     {{-- $navCats DEFINED ON APPSERVICEPROVIDER --}}
                     @foreach($navCats as $category)
                        <a href="{{route('categories.single', $category->latin_name)}}">{{$category->name}}</a>
                     @endforeach
                  </div>
               </div>

            </div>
         </div> {{-- Category mega menu end --}}
         
         <a class="nav-links" href="{{route('categories.foreign_books')}}">Китобҳои хориҷӣ</a>
         <a class="nav-links" href="{{route('authors')}}">Муаллифон</a>
         {{-- <a class="nav-btm-links" href="{{route('questions')}}">Вопрос - ответ</a> --}}
         <a class="nav-links" href="{{route('contacts')}}">Тамос</a>

      </div>  {{-- Navbar links end --}}
      

      {{-- global seach start --}}
      <form action="/search" method="get" class="searchbar" id="searchbar">
         <input type="text" list="search_keys" autocomplete="off" name="keyword" placeholder="Ҷустуҷӯ..." id="search_input" minlength="3" required>
         <datalist id="search_keys">
            @foreach ($allBooksNames as $n)
               <option value="{{$n}}">
            @endforeach
            @foreach ($allAuthorsNames as $n)
               <option value="{{$n}}">
            @endforeach
          </datalist>

         <button class="primary-btn" type="button" onclick="toogle_search()">
            <i class="fa fa-search"></i>
         </button>
      </form>  {{-- global seach end --}}

   </NAV> 
</header>



