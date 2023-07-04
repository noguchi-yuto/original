@extends('layouts.app')

@section('content')
    <div class="prose ml-4">
        <h2><span class="text-2xl">{{$user->name}}　</span>の本棚</h2>
    </div>
    <div class="prose ml-4">
        <h2>コミック詳細ページ</h2>
    </div>

    <table class="table w-full my-4" id="showTable">
        <form method="POST" action="{{route('books.infoUpdate',$book->id)}}">
            @csrf
            @method('PUT')
            <tr>
                <th><label for="book_title">タイトル</label></th>
                <td class="flex justify-center">
                    <input type="text" name="book_title" class="input input-bordered w-3/5" value="{{ $book->book_title }}" id="q" required>
                    {{--isbn(非表示)--}}
                    <input type="hidden" id="book_isbn" name="book_isbn">
                    {{--author(非表示)--}}
                    <input type="hidden" id="book_author" name="book_author">
                    {{--publisher(非表示)--}}
                    <input type="hidden" id="book_publisher" name="book_publisher">
                    {{--cover(非表示)--}}
                    <input type="hidden" id="book_coverURL" name="book_coverURL">
                </td>
                <td></td>
            </tr>
            <tr id="result_tr">
                <th><div>検索結果</div></th>
                <td><div id="results_map" class="flex flex-wrap"></div></td>
                <td></td>
            </tr>
            <tr>
                <th><label for="book_display">表示名</label></th>
                <td class="flex justify-center"><input type="text" name="book_display" class="input input-bordered w-3/5" value="{{$book->book_display}}" required></td>
                <td></td>
            </tr>
            <tr>
                <th><label for="book_number">冊数</label></th>
                <td class="flex justify-center"><input type="number" name="book_number" class="input input-bordered w-3/5" value="{{ $book->book_number }}" required min="0"></td>
                <td><button type="submit" class="btn normal-case btn-ghost bg-blue-400 hover:bg-blue-300 btn-ghost text-white">更新</button></td>
            </tr>
        </form>
        <tr>
            <td>
                {{--本棚に戻る--}}
                <a class="btn normal-case bg-blue-400 hover:bg-blue-300 btn-ghost text-white" href="/">本棚に戻る</a> 
            </td>
            <td></td>
            <td>
                {{-- コミック削除フォーム --}}
                <form method="POST" action="{{ route('books.destroy', $book->id) }}" class="my-2">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn normal-case bg-red-400 hover:bg-red-300 btn-ghost text-white" 
                        onclick="return confirm('id = {{ $book->book_title }} を削除します。よろしいですか？')">削除</button>
                </form>
            </td>
        </tr>
    </table>
    
    <script type="module" src="{{ asset('js/show_search.js') }}"></script>
@endsection