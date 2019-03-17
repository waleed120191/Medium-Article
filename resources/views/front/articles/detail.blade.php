@extends('layouts.front')

@section('content')

<div class="w-full lg:w-5/5 p-8 mt-6 lg:mt-0 text-black leading-normal bg-white border border-grey-light border-rounded">
    <!--Title-->
    <div class="font-sans">
               <span class="text-base text-blue font-bold"></span> <a href="{{ url('articles/') }}"
                                                                           class="text-base md:text-sm text-blue font-bold no-underline hover:underline">Back</a></p>
                       <h1 class="font-sans break-normal text-black pt-6 pb-2 text-xl">{{ $article->title }}</h1>
               <hr class="border-b border-grey-light">
    </div>

    {{ html_entity_decode(htmlspecialchars_decode($article['body'])) }}
    <?php   echo html_entity_decode(htmlspecialchars_decode($article['body'])); ?>

</div>

@endsection