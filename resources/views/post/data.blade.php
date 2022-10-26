@foreach($posts as $post)
    <div class="card">
        <div class="card-header d-inline" style="background-color: #e3f2fd;"><strong>{{ $post->title }}</strong> #
            by {{ $post->user->name }} ({{ $post->user->email }})
            @auth
                @if ($post->user->id === auth()->user()->id)
                    <div class="badge float-right">
                        <div class="badge float-right">
                        <a class="far fa-edit fa-2x mr-2" title="Edit"
                           href="{{ route('posts.edit', $post->id) }}"></a>
                        <a class="fas fa-trash-alt fa-2x" title="Delete"
                           href="{{ route('posts.destroy', $post->id) }}"></a>
                    </div>
        </div>
        @endif
        @endauth
    </div>
    <div class="card-body">
        {{ $post->text }}
    </div>
    <div class="">
        @if (is_array(unserialize($post->image)))
            @foreach(unserialize($post->image) as $image)
                <a href="/{{$image}}" data-fancybox="gallery">
                    <img src="/{{$image}}">
                </a>
            @endforeach
        @endif
    </div>
    @auth
        @if(in_array($post->id, $userLikes))
            <div class="d-inline">
                <div class="badge float-right">
                    <a id="post-like" data-id="{{ $post->id }}" class="fas fa fa-heart fa-2x mr-2" title="Set Like">
                        <span id="like-counter">{{ $likeCounter[$post->id] }}</span>
                    </a>
                </div>
            </div>
        @endif
        @if ($post->user->id !== auth()->user()->id && !in_array($post->id, $userLikes))
            <div class="d-inline">
                <div class="badge float-right">
                    <a id="post-like" data-id="{{ $post->id }}" class="far fa-heart fa-2x mr-2" title="Set Like" onclick="setLike({{ $post->id }})">
                        <span id="like-counter">{{ $likeCounter[$post->id] }}</span>
                    </a>
                </div>
            </div>
        @endif
    @endauth
    @guest
        <div class="d-inline">
            <div class="badge float-right">
                <a id="post-like" data-id="{{ $post->id }}" class="far fa-heart fa-2x mr-2" title="Set Like">
                    <span id="like-counter">{{ $likeCounter[$post->id] }}</span>
                </a>
            </div>
        </div>
    @endguest
    </div>
@endforeach

<script>
    function setLike(id)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.post( "like", {'id':id}).done(function (data){
            $('[data-id="'+id+'"]').find("#like-counter").html(data).parent().addClass('fas');
        })
    }
</script>