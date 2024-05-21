<form
    action="{{ url($form['url']) }}"
    method="POST"
>
    @method($form['method'])
    @csrf
    <div class="mb-3">
        <label for="title-content" class="form-label">Title Content</label>
        <input
        type="text"
        class="form-control"
        id="title-content"
        name="title-content"
        @if (isset($post->title))
            value="{{ old('title-content', $post->title) }}"
        @else
            value="{{ old('title-content') }}"
        @endif
        >
    </div>

    <div class="mb-3">
        <label for="body-content" class="form-label">Body Content</label>
        <textarea
        class="form-control"
        id="body-content"
        name="body-content"
        rows="7"
        >@if (isset($post->content)) {{ old('body-content', $post->content) }} @else {{ old('body-content') }} @endif</textarea>
    </div>
    <a href="{{ url('posts') }}" class="btn btn-secondary">Back to blog</a>
    <button type="submit" class="{{ $button['class'] }}">{{ $button['text'] }}</button>
</form>
@if ($form['method']=='PATCH')
<form action="{{ url("posts/$post->id") }}" method="post">
    @method('delete')
    @csrf
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endif
