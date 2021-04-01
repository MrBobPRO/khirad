<div class="footer">
   <div class="primary-container footer-inner">
      <div class="footer-left">
         <a href="/"><img src="{{asset('img/main/logo-foot.png')}}"></a>
         <p>
            Важно помнить, что формирование гармонии между работой и семьей – один из основных рецептов человеческого счастья, успехов и достижений, как в личной жизни, так и на профессиональном поприще!
         </p>
         <div class="footer-social">
            <a href="https://www.facebook.com/%D0%A5%D0%B8%D1%80%D0%B0%D0%B4-106239201477539" target="_blank"><img src="{{asset('img/main/facebook.png')}}"></a>
            <a href="https://www.instagram.com/khirad.21/" target="_blank"><img class="instagram" src="{{asset('img/main/instagram.png')}}"></a>
            <a href="#" target="_blank"><img src="{{asset('img/main/telegram.png')}}"></a>
         </div>
      </div>
      <div class="footer-middle">
         <h4>{{ __("Топ категории") }}</h4>
         <?php $c = 0; ?>
         @foreach ($navCats as $category)
            @if($c > 5) @break @endif
            <a href="{{route('categories.single', $category->id)}}">{{$category->name}}</a> 
            <?php $c++; ?>
         @endforeach
      </div>
      <div class="footer-right">
         <h4>{{ __("Контакты") }}</h4>
         <a href="#"><i aria-hidden="true" class="fas fa-map-marker-alt"></i> Таджикистан г. Душанбе <br>наш адрес</a>
         <a href="#"><i aria-hidden="true" class="fas fa-phone-alt"></i> Номер телефона</a>
         <a href="#"><i aria-hidden="true" class="fas fa-envelope"></i> Наша почта</a>
      </div>
   </div>
   <div class="copyright">
      © 2021 Хирад. {{ __("Все права защищены") }}
   </div>
</div>