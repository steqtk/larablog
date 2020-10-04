@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div id="post-data" class="col-md-8">
                {!! Form::open()->put()->route('posts.update', [$post->id])->multipart() !!}
                <div class="card">
                    <div class="card-header d-inline" style="background-color: #e3f2fd;">
                        {!! Form::text('title', '', $post->title)->required() !!}
                    </div>
                    <div class="card-body">
                        {!! Form::textarea('text', '', $post->text)->required() !!}
                    </div>
                    <div class="m-auto">
                        <div class="ml-auto mr-auto mb-3">
                            <input  name="post_image[]" type="file" multiple>
                        </div>
                        @if (is_array(unserialize($post->image)))
                            @foreach(unserialize($post->image) as $image)
                                <div class="post-images">
                                    <img class="edit-photo" src="/{{$image}}">
                                    <div class="delete-post-image"></div>
                                    {!! Form::hidden('post_image[]',$image) !!}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    {!! Form::submit("Save my post")->info() !!}
                </div>
            </div>
            {!! Form::hidden('post_id',$post->id) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
