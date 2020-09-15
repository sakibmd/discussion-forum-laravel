@extends('layouts.app')

@section('content')
 <div class="card">
    <div class="card-header">Create Discussion</div>
        <div class="card-body">
            @include('partials.error')
            <form action="{{ route('discussion.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="" class="form-control" id="title">
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content">
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="channel">Channel</label>
                        <select name="channel_id" id="channel_id" class="form-control">
                            @foreach ($channels as $channel)
                                <option  value="{{ $channel->id }}">{{ $channel->name }}</option>
                            @endforeach    
                        </select>         
                </div>

                <div class="form-group">
                    <button  type="submit" class="btn btn-success">Add Discussion</button>        
                </div>


            </form>
        </div>
</div>
        
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js"></script>
@endsection