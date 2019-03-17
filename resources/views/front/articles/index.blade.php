@extends('layouts.front')

@section('content')

    <div class="w-full lg:w-5/5 lg:mt-0 text-black leading-normal bg-grey-lightest border border-grey-lightest border-rounded mx-auto">
        @if(count($articles) > 0)
            @foreach($articles as $article)


                <div class="bg-white rounded overflow-hidden shadow-lg my-5 mx-10 border border-grey-light">

                    <div class="px-6 py-2">
                        <div class="font-bold text-xl cursor-pointer"
                             onclick='window.location.href = "{{ url("articles/{$article->id}/") }}";'>{{ $article->title }}</div>
                    </div>

                    <div class="px-6 text-sm">
                        <div class="">Written by <b>{{ $article->user->name }}</b>
                            on {{ date("F j, Y, g:i a", strtotime($article->created_at)) }}</div>
                    </div>

                    <div class="px-6 py-2 text-right">
                        @foreach($article->tags as $tag)
                            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2 mt-2">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>

            @endforeach
        @else
            <div class="bg-white rounded overflow-hidden shadow-lg my-5 mx-10 border border-grey-light">

                <div class="px-6 py-2">
                    <div class="font-bold text-xl cursor-pointer">Something went wrong!! We will come back soon.
                    </div>
                </div>


            </div>
        @endif
        <div class="text-right pr-10">
            {{ $articles->links() }}
        </div>
    </div>

@endsection
