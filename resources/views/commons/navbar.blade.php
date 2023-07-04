<header class="mb-4">
    <nav class="navbar bg-neutral text-neutral-content">
        {{-- トップページへのリンク --}}
        <div class="flex-1">
            <h1><a class="btn btn-ghost normal-case text-xl" href="/">BookList</a></h1>
        </div>
        @if(Auth::check())
        {{--ログアウト--}}
        <div class="flex-none">
            {{--プロフィール--}}
            <form method="POST" action="{{route('profile.index')}}" class="ml-10">
                @csrf
                @method('GET')
                {{--<a class="link link-hover" href="#">Profile</a>--}}
                <button type="submit" class="mx-3.0 text-white text-lg">Profile</button>
            </form>
            <form method="POST" action="{{ route('logout') }}" class="ml-10">
                @csrf
                <a class="link link-hover mx-3.5 text-white text-lg" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
            </form>
        </div>
        @else
        <div class="flex-none">
            {{--login--}}
            <a class="link link-hover text-info mx-3.5 text-white text-lg" href="{{ route('login') }}">login</a>
            {{--register--}}
            <a class="link link-hover text-info mx-3.5 text-white text-lg" href="{{ route('register') }}">sign up</a>
        </div>
        @endif
    </nav>
</header>