@extends('layouts.app')

@section('content')
    <div class="prose ml-4">
        <h2>{{$user->name}}の本棚</h2>
    </div>
    <div class="prose ml-4">
        <h2>コミック新規登録ページ</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('books.store') }}" class="w-1/2">
            @csrf

                <div class="form-control my-4">
                    <label for="book_title" class="label">
                        <span class="label-text">タイトル:</span>
                    </label>
                    <input type="text" name="book_title" class="input input-bordered w-full">
                    <label for="book_display" class="label">
                        <span class="label-text">表示名:</span>
                    </label>
                    <input type="text" name="book_display" class="input input-bordered w-full">
                    <label for="book_number" class="label">
                        <span class="label-number">冊数：</span>
                    </label>
                    <input type="number" name="book_number" class="input input-bordered w-full">
                </div>

            <button type="submit" class="btn btn-primary btn-outline">追加</button>
        </form>
    </div>
@endsection