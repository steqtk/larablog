@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div id="post-data" class="col-md-8">
                @if ($posts->count() > 0 )
                @foreach($posts as $post)
                    <div class="card">
                        <div class="card-header d-inline" style="background-color: #e3f2fd;"><strong>{{ $post->title }}</strong> #
                            by {{ $post->user->name }} ({{ $post->user->email }})
                            @auth
                                @if ($post->user->id === auth()->user()->id)
                                    <div class="badge float-right">
                                        <a id="post-edit" class="far fa-edit fa-2x mr-2" title="Edit" href="{{ route('posts.edit', $post->id) }}"></a>
                                        <a id="post-delete" class="fas fa-trash-alt fa-2x" title="Delete" href="{{ route('posts.destroy', $post->id) }}"></a>
                                    </div>
                                @endif
                            @endauth
                        </div>

                        <div class="card-body">
                            {{ $post->text }}
                        </div>
                        <div>
                            @if (is_array(unserialize($post->image)))
                              @foreach(unserialize($post->image) as $image)
                                <a href="/{{$image}}" data-fancybox="gallery">
                                    <img src="/{{$image}}">
                                </a>
                                @endforeach
                            @endif
                        </div>
                        @auth
                            @if ($post->user->id !== auth()->user()->id)
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
                @else
                    <div class="text-center text-danger"><h4>You haven't posts!</h4></div>
                    <a href="{{ route('posts.create') }}">
                    <div class="text-center text-info"><h3>Add another one -></h3></div>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
