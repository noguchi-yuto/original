@extends('layouts.app')
@section('content')
    @if (isset($user))
        <table class="table w-full my-4">
            <form method="POST" action="{{route('profile.nameUpdate')}}">
                @csrf
                @method('PUT')
                <tr>
                    <th><label for="book_title">名前</label></th>
                    <td><input type="text" name="user_name" class="input input-bordered" value="{{$user->name}}" required maxlength="10"></td>
                    <td><button type="submit" class="btn normal-case btn-ghost bg-blue-400 hover:bg-blue-300 btn-ghost text-white">更新</button></td> 
                </tr>
            </form>
            <form method="POST" action="{{route('profile.emailUpdate')}}">
                @csrf
                @method('PUT')
                <tr>
                    <th><label for="book_display">メールアドレス</label></th>
                    <td><input type="email" name="user_email" class="input input-bordered" value="{{$user->email}}"></td>
                    <td><button type="submit" class="btn normal-case btn-ghost bg-blue-400 hover:bg-blue-300 btn-ghost text-white">更新</button></td>
                </tr>
            </form>
        </table>
    @endif
@endsection
