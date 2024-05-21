<header>

    <div class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <strong>Blog</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('posts/') }}">Blog List</a>
                    </li>
                    @endif
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </ul>
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    @if (Auth::check())
                    <li class="nav-item">
                        <form action="{{ url('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger nav-link active" >Logout</button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link "  href="{{ url('login') }}">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</header>
