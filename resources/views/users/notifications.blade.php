@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('discussion.create') }}" class="btn btn-success">Add</a>
    </div>
 <div class="card">
    <div class="card-header">Notifications</div>

        <div class="card-body">
                  <ul class="list-group">
                      @foreach ($notifications as $notification)
                          <li class="list-group-item">
                              @if ($notification->type == 'LaravelForum\Notifications\NewReplyAdded')
                                  A new reply was added to your discussion
                                  <strong>{{ $notification->data['discussion']['title'] }}</strong>

                                  <a href="{{ route('discussion.show', $notification->data['discussion']['slug']) }}" class="btn btn-sm btn-success float-right">
                                      View Discussion
                                  </a>
                              @endif
                          </li>
                      @endforeach
                  </ul>

        </div>
</div>
        
@endsection
