<header class="mb-4">
    <nav class="navbar bg-neutral text-neutral-content">
        {{-- トップページへのリンク --}}
        <div class="flex-1">
            <h1><a class="btn btn-ghost normal-case text-xl" href="/">BookList</a></h1>
        </div>
        {{--ログアウト--}}
        <div class="flex-none">
            {{--プロフィール--}}
            <form method="POST" action="{{route('profile.index')}}" class="ml-10">
                @csrf
                @method('GET')
                {{--<a class="link link-hover" href="#">Profile</a>--}}
                <button type="submit">Profile</button>
            </form>
            <form method="POST" action="{{ route('logout') }}" class="ml-10">
                @csrf
                <a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
            </form>
        </div>
    </nav>
</header>