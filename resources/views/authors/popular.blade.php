@extends('templates.master')
@section('content')

<div class="authors-prime-container">

   <h1>Муаллифони машҳур</h1>

   {{-- Authors seach start --}}
   <div class="select2_single_container authors_search_container">
      <select class="select2_single select2_single_linked" data-placeholder="Муаллифи лозимаро пайдо намоед..." data-dropdown-css-class="select2_single_dropdown select2_authors_dropdown">
         <option></option>
         @foreach($allAuthors as $author)
            <option value="{{ route('authors.single', $author->latin_name)}}">{{$author->name}}</option>   
         @endforeach
      </select>
      <button class="primary-btn" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
   </div>
   {{-- Authors seach end --}}

   <div class="authors-list-container">
      <div class="authors-list">
         @foreach($authors as $author)
            <a href="{{route('authors.single', $author->latin_name)}}">
               <div>
                  <img src="{{asset('img/authors/thumbs/' . $author->photo)}}" alt="{{$author->name}}">
               </div>
               <h2>{{$author->name}}</h2>
            </a>
         @endforeach
      </div>
   </div>


   {{$authors->links()}}

</div>


@endsection