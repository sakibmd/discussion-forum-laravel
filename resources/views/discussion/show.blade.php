@extends('layouts.app')

@section('content')
    


<div class="card m-3">

    @include('partials.discussions-header')

        <div class="card-body">
              <div class="text-center">
                <strong>{{  $discussion->title  }}</strong>
            </div>
              <hr>
              {!! $discussion->content !!}
        </div>
</div>

<div class="card my-4">
    <div class="card-header">
        Reply
    </div>
    <div class="card-body">
        @auth
            <form action="{{ route('replies.store', $discussion->slug) }}" method="POST">
                @csrf 
                <div class="form-group">
                    <input id="reply" type="hidden" name="reply">
                    <trix-editor input="reply"></trix-editor>
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-success">Add Reply</button>
                </div>
            </form>
        @else 
            <a href="{{ route('login') }}" class="btn btn-info">Sign in to add reply</a>
        @endauth
    </div>
</div>

@endsection



@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js"></script>
@endsection