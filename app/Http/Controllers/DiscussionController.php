<?php

namespace LaravelForum\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelForum\Discussion;
use LaravelForum\Http\Requests\CreateDiscussionRequest;
use LaravelForum\Notifications\ReplyMarkedAsBestReply;
use LaravelForum\Reply;

class DiscussionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store');
    }
    

    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussion.index')->with('discussions', Discussion::filterByChannels()->paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        auth()->user()->discussions()->create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'content' => $request->content,
            'channel_id' => $request->channel_id,
        ]);

        session()->flash('success', 'Discussion Added Successfuly');
        return redirect(route('discussion.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('discussion.show')->with('discussion', $discussion);
    }



     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply(Discussion $discussion, Reply $reply)
    {
        //dd($reply);
        //$discussion->markAsBestReply($reply);


        $discussion->reply_id = $reply->id;
        $discussion->save();

        if($reply->owner->id ==$discussion->author->id ){
            session()->flash('success', 'Mark as Best Reply');
            return redirect()->back();
        }

        $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));

        session()->flash('success', 'Mark as Best Reply');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
