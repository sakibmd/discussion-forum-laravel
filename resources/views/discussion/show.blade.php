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

@foreach ($discussion->replies()->paginate(3) as $reply)
    <div class="card my-5">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <img src="{{ Gravatar::src($reply->owner->email) }}"  height="40px" width="40[x]" style="border-radius: 50%;" alt="">
                    <span>{{ $reply->owner->name }}</span>
                </div>
                <div>
                   @if (auth()->user()->id == $discussion->user_id)
                    <form action="{{ route('discussions-best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" method="post">
                        @csrf 
                        <button type="submit" class="btn btn-primary">Mark as best reply</button>
                    </form>
                   @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            {!! $reply->content !!}
        </div>
    </div>
@endforeach
{{ $discussion->replies()->paginate(3)->links() }}

<div class="card my-4">
    <div class="card-header">
        Reply
    </div>
    <div class="card-body">
        @auth
            <form action="{{ route('replies.store', $discussion->slug) }}" method="POST">
                @csrf 
                @include('partials.error')
                <div class="form-group">
                    <input id="content" type="hidden" name="content">
                    <trix-editor input="content">{{ old('content') }}</trix-editor>
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