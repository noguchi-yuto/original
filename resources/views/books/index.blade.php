@extends('layouts.app')

@section('content')
    @if(isset($user))
        <div class="prose ml-4">
            <h2>{{$user->name}}の本棚</h2>
        </div>
        <div class="w-800 h-1000">
            @if (isset($books))
                <form action={{route('books.index')}} class="justify-self-end">
                    <div>
                        <input type="text" name="word" class="input input-bordered">
                        <input type="submit" class="w-20 h-10 rounded bg-blue-400 hover:bg-blue-300 text-white"  value="検索">                   
                    </div>
                </form>
                <table class="table table-zebra w-full my-4">
                    <thead>
                        <tr>
                            <th>表示名</th>
                            <th>冊数</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            @if($user->id===$book->user_id)
                                <tr>
                                    <td>{{ $book->book_display}}</td>
                                    <td class="place-items-center">
                                        <div>
                                            <div>
                                                <form method="POST" action="{{route('books.numberFluctuationMinus',$book->id)}}" class="float-left">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="w-5 h-5 rounded bg-blue-400 hover:bg-blue-300 text-white">－</button>
                                                </form>                                      
                                            </div>
                                            <div class="float-left mx-8">{{ $book->book_number}}</div>
                                            <div>
                                                <form method="POST" action="{{route('books.numberFluctuationPlus',$book->id)}}" class="float-left">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="w-5 h-5 rounded bg-blue-400 hover:bg-blue-300 text-white">＋</button>
                                                </form>                                          
                                            </div>
                                        </div>
                                    </td>
                                    <td><input type="button" onclick="location.href='{{route('books.show',$book->id)}}'"value="詳細" class="bg-blue-400 hover:bg-blue-300 text-white rounded px-4 py-2"></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        {{-- コミック新規登録ページへのリンク --}}
        <a class="btn btn-primary" href="{{ route('books.create') }}">コミック新規登録</a>
    @endif
@endsection