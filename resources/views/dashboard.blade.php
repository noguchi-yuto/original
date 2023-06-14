@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="sm:grid sm:grid-cols-3 sm:gap-10">
            <div class="sm:col-span-2">
                {{-- 本棚 --}}
                @include('books.index')
            </div>
        </div>
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-enter my-10">
                <div class="max-w-md mb-10">
                    <h2>Book Listへようこそ！</h2>
                    {{-- ログインページへのリンク --}}
                    <h3>アカウントをお持ちの方</h3>
                    <a class="btn btn-primary btn-lg normal-case" href="{{route('login')}}">login</a>
                    {{-- ユーザー登録ページへのリンク --}}
                    <h3>アカウントをお持ちでない方</h3>
                    <a class="btn btn-primary btn-lg normal-case" href="{{route('register')}}">sign up</a>                    
                </div>
            </div>
        </div>
    @endif
@endsection