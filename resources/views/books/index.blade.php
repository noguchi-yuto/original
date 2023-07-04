@extends('layouts.app')

@section('content')
    @if(isset($user))
        <script>
        function display(isbn,cover,publisher,author){
            // ISBNを取得
            var xhr = new XMLHttpRequest();
            xhr.open('GET',"https://api.openbd.jp/v1/get?isbn=" + isbn +"&pretty",true);
            if(isbn != null){
                xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var display = JSON.parse(xhr.responseText);
                
                    if (display && display.length > 0 && display[0].summary) {
                      // レスポンスから情報を取得
                      var displayCoverImage = display[0].summary.cover;
                      var displayPublisher = display[0].summary.publisher;
                      var displayAuthor = (display[0].summary.author).replace(/／著/g,"　");
                
                      //表紙を表示
                      cover.src = displayCoverImage;
                      publisher.textContent = displayPublisher;
                      author.textContent = displayAuthor;
                    }
                  }
                };
                xhr.send(); 
            }
        }
        </script>
        <script>

            
        </script>
        <div class="prose ml-4 my-4">
            <h2><span class="text-2xl">{{$user->name}}　</span>の本棚　<span class="text-2xl">{{$number}}</span>冊</h2>
        </div>
        @if (isset($books))
            <div class="flex justify-between">
                {{-- コミック新規登録ページへのリンク --}}
                <a class="btn normal-case bg-blue-400 hover:bg-blue-300 btn-ghost text-white" href="{{ route('books.create') }}">コミック新規登録</a>
                <form action={{route('books.index')}} class="justify-self-end">
                    <div>
                        <input type="text" name="word" placeholder="検索したいワードを入力" class="input input-bordered w-70" value="{{$keyword}}">
                        <input type="submit" class="btn normal-case bg-blue-400 hover:bg-blue-300 btn-ghost text-white"  value="検索">
                        <a type="button" href="{{route('books.index')}}" class="btn normal-case bg-blue-400 hover:bg-blue-300 btn-ghost text-white">リセット</a>
                    </div>
                </form>
            </div>

            <table class="table table-zebra w-full my-4" id="indexTable">
                <thead>
                    <tr>
                        <th class="text-center w-1/4">本</th>
                        <th class="text-center">冊数</th>
                        <th class="text-center">表紙</th>
                        <th class="text-center">出版社</th>
                        <th class="text-center w-1/4">作者</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        @if($user->id===$book->user_id)
                            <tr class="border-b-2">
                                <td class="text-center w-200">{{ $book->book_display}}</td>
                                <td>
                                    <div class="flex justify-center items-center">
                                        <form method="POST" action="{{route('books.numberFluctuationMinus',$book->id)}}" class="float-left">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="w-5 h-5 rounded bg-blue-400 hover:bg-blue-300 text-white">－</button>
                                        </form>                                      
                                        <div class="float-left mx-8">{{ $book->book_number}}</div>
                                        <form method="POST" action="{{route('books.numberFluctuationPlus',$book->id)}}" class="float-left">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="w-5 h-5 rounded bg-blue-400 hover:bg-blue-300 text-white">＋</button>
                                        </form>                                          
                                    </div>
                                </td>
                                <input type="hidden" id="bookIsbn{{$book->id}}" value="{{$book->book_isbn}}">
                                <td>
                                  {{--画像--}}
                                  <div class="flex justify-center">
                                      @if($book->book_coverURL)
                                      <img id="bookCover{{$book->id}}" class="book-image w-20 h-30" src="{{$book->book_coverURL}}" alt="本の表紙">
                                      @else
                                      <img id="bookCover{{$book->id}}" class="book-image w-20 h-30" src='/png/20220330_object.png' alt="本の表紙">
                                      @endif
                                  </div>
                                </td>
                                <td class="text-center">
                                    {{--出版社--}}
                                    <p id="bookPublisher{{$book->id}}">{{$book->book_publisher}}</p>
                                </td>
                                <td class="text-center">
                                    {{--作者--}}
                                    <p id="bookAuthor{{$book->id}}">{{$book->book_author}}</p>
                                </td>
                                <td><input type="button" onclick="location.href='{{route('books.show',$book->id)}}'"value="編集" class="bg-blue-400 hover:bg-blue-300 text-white rounded px-4 py-2"></td>
                            </tr>
                            <script>
                                var isbn = document.getElementById('bookIsbn{{$book->id}}').value;
                                var cover = document.getElementById('bookCover{{$book->id}}');
                                var publisher = document.getElementById('bookPublisher{{$book->id}}');
                                var author = document.getElementById('bookAuthor{{$book->id}}');
                                display(isbn,cover,publisher,author);
                            </script>
                        @endif
                    @endforeach
                    @if(!empty($keyword))
                        @if($count==0)
                        <h1 class="text-3xl flex justify-center items-center">一致する本がありませんでした</h1>
                        @else
                        <h1 class="text-3xl flex justify-center items-center">{{$count}}件ヒットしました</h1>
                        @endif
                    @endif
                </tbody>
            </table>
            {{$books->onEachSide(5)->links()}}
        @endif
    @endif
@endsection