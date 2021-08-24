
@extends('templates.master')
@section('content')

<div class="primary-container questions-prim-cont">
   <h1>Савол - ҷавоб</h1>

   <div class="accordion-container">
      <div class="accordion" id="accordionExample">
         
         {{-- FIRST ITEM --}}
         <div class="accordion-item">
           <h2 class="accordion-header" id="headingOne">
             <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Ман муаллиф ҳастам ва мехоҳам китоби худро ба корбарони сомона пешниҳод кунам. Инро чӣ тавр бояд анҷом диҳам?
             </button>
           </h2>
           <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
             <div class="accordion-body">
                Мо аз Шумо барои ҳамкорӣ бисёр миннатдорем. Шумо метавонед китоби худро бо адреси сомонаи мо фиристед ва мо кӯшиш мекунем пас аз коркард, онро дар сомонаи худ ҷой диҳем.
             </div>
           </div>
         </div>

         {{-- SECOND ITEM --}}
         <div class="accordion-item">
           <h2 class="accordion-header" id="headingTwo">
             <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Чӣ тавр метавонем китобҳои аудиоиро гӯш кунем?
             </button>
           </h2>
           <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
             <div class="accordion-body">
                Шумо ҳаргоҳ, ки хостед китобҳои ауидоиро бидуни мушкилӣ ҳам дар худи сайт гуш кунед ва ҳам барои худ бигиред.
             </div>
           </div>
         </div>

         {{-- THIRD ITEM --}}
         <div class="accordion-item">
           <h2 class="accordion-header" id="headingThree">
             <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Китобҳои машҳуртарини сайт кадомҳоянд?
             </button>
           </h2>
           <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
             <div class="accordion-body">
                Дар сайти мо китобҳои машҳур раддабандӣ шудаанд, Шумо метавонед аз рӯи раддабандӣ китобҳои машҳури мувафиқи завқатонро мутолеа намоед.
             </div>
           </div>
         </div>


         {{-- FORTH ITEM --}}
         <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
               <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Оё шумо метавонед китобҳоро ба дилхоҳ кишвар расонед?
               </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
               <div class="accordion-body">
                  Бале муштарии азиз! Мо ин имкониятро дорем. Шумо метавонед китоби мавриди назаратонро супориш диҳед. Корбарони мо ба Шумо дастрас мекунанд.
               </div>
            </div>
         </div>


        {{-- FIFTH ITEM --}}
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                Фармоиш кай расонида мешавад?
              </button>
          </h2>
          <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Муҳлати расонидани китоб муштарии азиз вобаста ба манзил мебошад. Аммо мо кӯшиш мекунем дар кутоҳтарин фурсат китобҳоро дастрасӣ Шумо гардонем.
              </div>
          </div>
        </div>

        {{-- SIX ITEM --}}
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingSix">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                Арзиши интиқоли китоб чанд пул аст?
              </button>
          </h2>
          <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Арзиши интиқоли вобаста ба ҳаҷми китоб ва мавқеи зисти супоришгр вобастагӣ дорад.
              </div>
          </div>
        </div>

      </div> {{-- ACCORDION --}}
   </div> {{-- ACCORDION CONTAINER--}}

</div>{{-- PRIMARY CONTAINER--}}


@endsection