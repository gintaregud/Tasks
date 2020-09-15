<?php



namespace App\Http\Controllers;



use App\Task;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $this->filter($request);



        if (!empty($filter['status_id'])) {
            $task = Task::where('status_id', $filter['status_id'])->orderBy('task_name')->get();
        } else {
            $task = Task::orderBy('task_name')->get();;
        }

        $status = Status::orderBy('name')->get();
        return view('task.index', ['tasks' => $task, 'statuses' => $status]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Status::orderBy('id')->get();
        return view('task.create', ['statuses' => $status]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_name' => 'required|max:128',
            'task_description' => 'required',
            'status_id' => 'required',
            'add_date' => 'date|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return redirect('task/create')->withErrors($validator)->withInput();
        }

        $task = new Task();
        $task->fill($request->all());
        $task->save();



        return redirect()->route('task.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $status = Status::orderBy('name')->get();
        return view('task.edit', ['task' => $task, 'statuses' => $status]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'task_name' => 'required|max:128',
            'task_description' => 'required',
            'status_id' => 'required',
            'add_date' => 'date|date_format:Y-m-d',
        ]);



        if ($validator->fails()) {
            return redirect('task/' . $task->id . '/edit')->withErrors($validator)->withInput();
        }

        $task->fill($request->all());
        $task->save();
        return redirect()->route('task.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index');
    }



    public function filter($request)
    {
        $status_id = $request->query('status_id');
        $query = '?status_id=' . $status_id;
        if (!isset($status_id) && !$status_id > 0) {
            $status_id = FALSE;
            $query = '';
        }



        return compact('status_id', 'query');
    }
}
