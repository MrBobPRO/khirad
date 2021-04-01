
@extends('templates.master')
@section('content')

<div class="primary-container questions-prim-cont">
   <h1>{{ __("Вопрос - ответ") }}</h1>

   <div class="accordion-container">
      <div class="accordion" id="accordionExample">
         
         {{-- FIRST ITEM --}}
         <div class="accordion-item">
           <h2 class="accordion-header" id="headingOne">
             <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
               Смогу ли я скачать купленные книги через месяц после покупки?
             </button>
           </h2>
           <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
             <div class="accordion-body">
               <b>Конечно же сможете.</b> Все ваши купленные книги будут хранятся в архиве. Оттуда вы сможете скачать их когда захотите, бесконечный раз! Книга — один из видов печатной продукции: непериодическое издание, состоящее из сброшюрованных или отдельных бумажных листов (страниц) или тетрадей, на которых нанесена типографским или рукописным способом текстовая и графическая (иллюстрации) информация, имеющее, как правило, твёрдый переплёт
             </div>
           </div>
         </div>

         {{-- SECOND ITEM --}}
         <div class="accordion-item">
           <h2 class="accordion-header" id="headingTwo">
             <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
               Какойто второй вопрос
             </button>
           </h2>
           <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
             <div class="accordion-body">
               <b>Конечно же сможете.</b> Все ваши купленные книги будут хранятся в архиве. Оттуда вы сможете скачать их когда захотите, бесконечный раз! Книга — один из видов печатной продукции: непериодическое издание, состоящее из сброшюрованных или отдельных бумажных листов (страниц) или тетрадей, на которых нанесена типографским или рукописным способом текстовая и графическая (иллюстрации) информация, имеющее, как правило, твёрдый переплёт
             </div>
           </div>
         </div>

         {{-- THIRD ITEM --}}
         <div class="accordion-item">
           <h2 class="accordion-header" id="headingThree">
             <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
               Вопросик №3 опросик 3 ответик 3 
             </button>
           </h2>
           <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
             <div class="accordion-body">
               <b>Конечно же сможете.</b> Все ваши купленные книги будут хранятся в архиве. Оттуда вы сможете скачать их когда захотите, бесконечный раз! Книга — один из видов печатной продукции: непериодическое издание, состоящее из сброшюрованных или отдельных бумажных листов (страниц) или тетрадей, на которых нанесена типографским или рукописным способом текстовая и графическая (иллюстрации) информация, имеющее, как правило, твёрдый переплёт
             </div>
           </div>
         </div>


         {{-- FORTH ITEM --}}
         <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
               <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Ну и на последок 4 вопросище
               </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
               <div class="accordion-body">
                  <b>Конечно же сможете.</b> Все ваши купленные книги будут хранятся в архиве. Оттуда вы сможете скачать их когда захотите, бесконечный раз! Книга — один из видов печатной продукции: непериодическое издание, состоящее из сброшюрованных или отдельных бумажных листов (страниц) или тетрадей, на которых нанесена типографским или рукописным способом текстовая и графическая (иллюстрации) информация, имеющее, как правило, твёрдый переплёт
               </div>
            </div>
         </div>

      </div> {{-- ACCORDION --}}
   </div> {{-- ACCORDION CONTAINER--}}

</div>{{-- PRIMARY CONTAINER--}}


@endsection