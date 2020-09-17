<div class="card-header">
       
    <div class="d-flex justify-content-between">
         <div>
             <img style="height:45px; width: 45px; border-radius: 50%;" src="{{ Gravatar::src($discussion->author->email) }}" alt="">
             <strong class="ml-2">{{ $discussion->author->name }}</strong>
         </div>
         <div>
             <a href="{{ route('discussion.show', $discussion->slug) }}" class="btn btn-success">View</a>
         </div>
    </div>
 </div>