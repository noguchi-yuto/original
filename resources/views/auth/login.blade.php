@extends('layouts.app')

@section('content')

    <div class="prose mx-auto text-center">
        <h2>Log in</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('login') }}" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" class="input input-bordered w-full" required>
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full" required>
            </div>
            {{-- ユーザ登録ページへのリンク --}}
            <p class="mt-2">アカウントをお持ちでない方は <a class="link link-hover text-info" href="{{ route('register') }}">こちら</a></p>
            <button type="submit" class="btn btn-primary btn-block normal-case bg-blue-400 hover:bg-blue-300">Log in</button>
        </form>
    </div>
@endsection