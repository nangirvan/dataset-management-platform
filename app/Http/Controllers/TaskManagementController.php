<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskValidation;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('users')->where('id_uploader', auth()->id())->get();

        return view('task-management.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task-management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskValidation $request)
    {
        $dataset = ($request->validated()['name'] == null) ? $request->validated()['dataset'] : $request->validated()['name'].'.zip';
        $name = ($request->validated()['name'] == null) ? explode('.', $request->validated()['dataset'])[0] : $request->validated()['name'];
        
        $data = [
            'id_uploader' => auth()->id(),
            'name' => $name,
            'file_path' => 'datasets/user'.auth()->id().'/'.$dataset,
            'file_size' => '1020',
            'uploaded_at' => Carbon::now(),
        ];
        
        Task::create($data);

        return redirect()->route('home')->with('success', 'Task berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
