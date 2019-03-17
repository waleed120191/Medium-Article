@extends('layouts.admin')

@section('content')


        <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded float-right mb-6"
                onclick="window.location.href = '{{ url('admin/articles/create') }}';">
            New
        </button>

        <div class="clearfix"></div>

        <div class="bg-white shadow-md rounded">
            <table class="text-left w-full border-collapse">
                <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                <thead>
                <tr>
                    <th class="py-4 px-6 bg-blue-darker font-bold uppercase text-sm text-white border-b border-grey-light w-4/5">
                        Title
                    </th>
                    <th class="py-4 px-6 bg-blue-darker font-bold uppercase text-sm text-white border-b border-grey-light w-1/5">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($articles as $article)
                    <tr class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light w-4/5">{{ $article->title }}</td>
                        <td class="py-4 px-6 border-b border-grey-light w-1/5">
                            <a href="{{ url("admin/articles/{$article->id}/edit") }}"
                               class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark">Edit</a>

                            <a href="{{ url("admin/articles/{$article->id}") }}" data-method="delete" data-token="{{ csrf_token() }}" data-confirm="Are you sure?"
                                    class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-red hover:bg-red-dark">Delete</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="text-right pr-10">
                {{ $articles->links() }}
            </div>

        </div>

@endsection
