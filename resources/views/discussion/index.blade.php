@extends('layouts.app')

@section('content')
    @include('partials.successMsg')

@foreach ($discussions as $discussion)
<div class="card m-3">
    

    @include('partials.discussions-header')

        <div class="card-body">
            <div class="text-center">
                <strong>{{  $discussion->title  }}</strong>
            </div>
        </div>
</div>
@endforeach
      
{{ $discussions->links() }}


@endsection
