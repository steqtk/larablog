@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div id="post-data" class="col-md-8">
                {!! Form::open()->post()->route('posts.store')->multipart() !!}
                <div class="card">
                    <div class="card-header d-inline" style="background-color: #e3f2fd;">
                        {!! Form::text('title', '', '')->required() !!}
                    </div>
                    <div class="card-body">
                        {!! Form::textarea('text', '', '')->required() !!}
                    </div>
                    <div class="ml-auto mr-auto mb-3">
                        <input name="post_image[]" type="file" multiple>
                    </div>
                    {!! Form::submit("Save my post")->info() !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
