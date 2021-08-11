<div class="footer">
   <div class="primary-container footer-inner">

      <div class="footer-left">
         <a href="/"><img src="{{asset('img/main/logo-foot.png')}}" alt="Хирад лого"></a>
         <p>
            Важно помнить, что формирование гармонии между работой и семьей – один из основных рецептов человеческого счастья, успехов и достижений, как в личной жизни, так и на профессиональном поприще!
         </p>
         <div class="footer-social">
            <a href="https://www.facebook.com/%D0%A5%D0%B8%D1%80%D0%B0%D0%B4-106239201477539" target="_blank"><img src="{{asset('img/main/facebook.png')}}"></a>
            <a href="https://www.instagram.com/khirad.21/" target="_blank"><img class="instagram" src="{{asset('img/main/instagram.png')}}"></a>
            <a href="https://t.me/Khirad21" target="_blank"><img src="{{asset('img/main/telegram.png')}}"></a>
         </div>
      </div>

      <div class="footer-middle">
         <h4>{{ __("Топ категории") }}</h4>
            <a href="{{route('categories.single', 1)}}">Адабиёт</a>
            <a href="{{route('categories.single', 6)}}">Кӯдакон ва наврасон</a>
            <a href="{{route('categories.single', 2)}}">Донишномаҳо</a>
            <a href="{{route('categories.single', 3)}}">Забоншиносӣ</a>
            <a href="{{route('categories.single', 4)}}">Зиндагинома</a>
            <a href="{{route('categories.single', 5)}}">Иқтисодиёт</a>
      </div>

      <div class="footer-right">
         <h4>{{ __("Контакты") }}</h4>
         <a href="#"><i aria-hidden="true" class="fas fa-map-marker-alt"></i> Таджикистан г. Душанбе <br>Кучаи Шамси Б</a>
         <a href="#"><i aria-hidden="true" class="fas fa-phone-alt"></i> +992 927685858</a>
         <a href="#"><i aria-hidden="true" class="fas fa-envelope"></i> khirad2121@gmail.com</a>
      </div>

   </div>
   <div class="copyright">
      © 2021 Хирад. {{ __("Все права защищены") }}
   </div>
</div>