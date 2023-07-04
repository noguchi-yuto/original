@extends('layouts.app')

@section('content')
    <div class="prose ml-4">
        <h2><span  class="text-2xl">{{$user->name}}　</span>の本棚</h2>
    </div>
    <div class="prose ml-4">
        <h2>コミック新規登録ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('books.store') }}" class="w-3/4">
            @csrf
            <div class="form-control my-4">
                {{--タイトル--}}
                <div class="my-3">
                    <label for="book_title" class="label">
                        <span class="label-text text-xl">タイトル:</span>
                    </label>
                    <input type="search" name="book_title" class="input input-bordered w-full" id="q" required>
                    <div>
                        <div id="results"></div>
                        <div id="results_map" class="flex flex-wrap w-full"></div>
                    </div>                    
                </div>

                {{--表示名--}}
                <div class="my-3">
                    <label for="book_display" class="label">
                        <span class="label-text text-xl">表示名:</span>
                    </label>
                    <input type="text" name="book_display" class="input input-bordered w-full" required>                    
                </div>

                {{--冊数--}}
                <div class="my-3">
                    <label for="book_number" class="label">
                        <span class="label-number text-xl">冊数：</span>
                    </label>
                    <input type="number" name="book_number" class="input input-bordered w-full" min="0" required>                    
                </div>

                {{--isbn(非表示)--}}
                <input type="hidden" id="book_isbn" name="book_isbn">
                {{--author(非表示)--}}
                <input type="hidden" id="book_author" name="book_author">
                {{--publisher(非表示)--}}
                <input type="hidden" id="book_publisher" name="book_publisher">
                {{--cover(非表示)--}}
                <input type="hidden" id="book_coverURL" name="book_coverURL">
            </div>
            <div class="flex justify-between">
                <div>
                    {{--本棚に戻る--}}
                    <a class="btn normal-case bg-blue-400 hover:bg-blue-300 btn-ghost text-white" href="/">本棚に戻る</a>               
                </div>  
                <div>
                    <button type="submit" class="btn text-blue-400 border-blue-400 font-semibold rounded hover:bg-blue-100">追加</button>
                </div>
            </div>
        </form>
    </div>
    <script type="module" src="{{ asset('js/search.js') }}"></script>
@endsection