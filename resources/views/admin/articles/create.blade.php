@extends('layouts.admin')

@section('content')

    <div class="w-full">

        @if ($errors->any())
            <div class="bg-red-lightest border border-red-light text-red-dark px-4 py-2 mb-2 rounded relative" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ url('admin/articles') }}" method="POST">
            @csrf
            <div class="flex items-center border-b border-b-2 border-teal py-2">
                <input name="title"
                       class="appearance-none bg-transparent border-none w-full text-grey-darker mr-3 py-1 px-2 leading-tight focus:outline-none"
                       type="text" placeholder="Title" aria-label="Title" value="{{ old('title') }}">
            </div>

            <div class="flex items-center border-b border-b-2 border-teal py-2 w-100">
                <div id="editor" class="min-w-full">
                    <?php echo old('body'); ?>
                </div>

                <textarea id='ck' name="body" class="invisible">
                </textarea>

            </div>

            <div class="flex items-center border-b border-b-2 border-teal py-2 tag-holder">
                <input name="tag" id="tagit"
                       class="appearance-none bg-transparent border-none w-full text-grey-darker mr-3 py-1 px-2 leading-tight focus:outline-none"
                       type="text" placeholder="Tag" aria-label="Tag" value="{{ old('tag') }}" >
            </div>

            <button id='article-submit'
                    class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded float-right my-6"
                    type="submit">
                Save
            </button>


        </form>

    </div>

    <script>

        $(document).ready(function () {
            $("#tagit").tagit({
                allowSpaces: true,
                singleFieldDelimiter: ';',
                allowDuplicates: true,
                autocomplete: {
                    source: "{{ url('admin/tags') }}",
                },
                placeholderText: 'Tag'
            });
        });

        BalloonEditor
            .create(document.querySelector('#editor'), {
                placeholder: 'Start your article from here!',
                ckfinder: {
                    uploadUrl: '{{ url('admin/upload') }}',

                }

            })
            .then(editor => {
                window.editor = editor
            })
            .catch(error => {
                console.error(error);
            });

        document.getElementById('article-submit').onclick = () => {
            document.querySelector('#ck').value = editor.getData();
        }

    </script>

@endsection
