<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Blog Application</h1>
        <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        @if (Auth::check())
        <p>
            <a href="{{ url('posts/create') }}" class="btn btn-success my-2">Create New Blog</a>
        </p>
        @endif
        </div>
    </div>
</section>
