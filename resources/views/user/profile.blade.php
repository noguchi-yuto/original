@extends('layouts.app')

@section('content')
    <div class="prose ml-4">
        <h2>{{$user->name}}のプロフィール</h2>
    </div>
    
    <table class="table w-full my-4">
        <tr>
            <th><label for="name">名前</label></th>
            <td><input type="text" name="name" value="{{ $user->name }}"></td>
        </tr>
        <tr>
            <th><label for="email">メールアドレス</label></th>
            <td><input type="text" name="email" value="{{$user->email}}"></td>
            <td><button type="submit">更新</button></td>
        </tr>
    </table>
@endsection