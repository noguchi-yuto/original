@extends('layouts.app')

@section('content')
    <div class="prose ml-4">
        <h2>{{$user->name}}の本棚</h2>
    </div>
    <div class="prose ml-4">
        <h2>コミック詳細ページ</h2>
    </div>

    <table class="table w-full my-4">
        <form method="POST" action="{{route('books.titleUpdate',$book->id)}}">
            @csrf
            @method('PUT')
            <tr>
                <th><label for="book_title">タイトル</label></th>
                <td><input type="text" name="book_title" class="input input-bordered" value="{{ $book->book_title }}"></td>
                <td><button type="submit" class="btn normal-case btn-ghost bg-blue-400 hover:bg-blue-300 btn-ghost text-white">更新</button></td> 
            </tr>
        </form>
        <form method="POST" action="{{route('books.displayUpdate',$book->id)}}">
            @csrf
            @method('PUT')
            <tr>
                <th><label for="book_display">表示名</label></th>
                <td><input type="text" name="book_display" class="input input-bordered" value="{{$book->book_display}}"></td>
                <td><button type="submit" class="btn normal-case btn-ghost bg-blue-400 hover:bg-blue-300 btn-ghost text-white">更新</button></td>
            </tr>
        </form>
        <form method="POST" action="{{route('books.numberUpdate',$book->id)}}">
            @csrf
            @method('PUT')
            <tr>
                <th><label for="book_number">冊数</label></th>
                <td><input type="number" name="book_number" class="input input-bordered" value="{{ $book->book_number }}"></td>
                <td><button type="submit" class="btn normal-case btn-ghost bg-blue-400 hover:bg-blue-300 btn-ghost text-white">更新</button></td>
            </tr>
        </form>    
        
    </table>
    {{-- コミック削除フォーム --}}
    <form method="POST" action="{{ route('books.destroy', $book->id) }}" class="my-2">
        @csrf
        @method('DELETE')
        
        <button type="submit" class="btn normal-case bg-red-400 hover:bg-red-300 btn-ghost text-white" 
            onclick="return confirm('id = {{ $book->book_title }} を削除します。よろしいですか？')">削除</button>
    </form>
    {{--本棚に戻る--}}
    <a class="btn normal-case bg-blue-400 hover:bg-blue-300 btn-ghost text-white" href="/">本棚に戻る</a>
@endsection