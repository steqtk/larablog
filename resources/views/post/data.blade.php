@foreach($posts as $post)
    <div class="card">
        <div class="card-header"><strong>{{ $post->title }}</strong> # by {{ $post->user->name }} ({{ $post->user->email }})</div>

        <div class="card-body">
            {{ $post->content }}
        </div>
        <div class="card-footer">
            @foreach(unserialize($post->photo) as $photo)
                <a href="{{ asset ('img') }}/{{$photo}}" data-fancybox="gallery">
                    <img src="{{ asset ('img') }}/{{$photo}}">
                </a>
            @endforeach
        </div>
    </div>
@endforeach