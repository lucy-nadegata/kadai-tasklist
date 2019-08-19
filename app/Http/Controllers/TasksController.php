<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/*
        $messages = Task::all();
        
        return view('tasks.index',[
            'messages' => $messages,
            ]);
*/

        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $messages = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'messages' => $messages,
            ];
            return view('tasks.index',[
            'messages' => $messages,
            ]);
        }
        
        return view('welcome', $data);            

/*
        return view('welcome');            
*/

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $message = new Task;
        
        return view('tasks.create',[
            'message' => $message,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'status' => 'required|max:10',
            'content' => 'required|max:191',
            ]);
/*        
        $message = new Task;
        $message->status = $request->status;
        $message->content = $request->content;
        $message->save();
*/
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Task::find($id);

        if (\Auth::id() === $message->user_id) {
        return view('tasks.show',[
            'message' => $message,
            ]);
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Task::find($id);
        
        if (\Auth::id() === $message->user_id) {
        return view('tasks.edit',[
            'message' => $message,
            ]);
        }
        return redirect('/');
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

        if (\Auth::id() === $message->user_id) {
        $this->validate($request,[
            'status' => 'required|max:10',
            'content' => 'required|max:191',
            ]);
        
        $message = Task::find($id);
        $message->status = $request->status;
        $message->content = $request->content;
        $message->save();
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Task::find($id);
        if (\Auth::id() === $message->user_id) {
        $message->delete();
        }
        return redirect('/');
    }
}
