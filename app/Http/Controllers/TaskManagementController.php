<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevokeBookingValidation;
use App\Http\Requests\BookingValidation;
use App\Http\Requests\CreateTaskValidation;
use App\Models\Task;
use App\Models\User;
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

        return redirect()->route('task-management.index')->with('success', 'Task berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('home');
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
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();

        return redirect()->route('task-management.index')->with('success', 'Task berhasil dihapus');
    }

    public function booking(BookingValidation $request)
    {
        User::find(auth()->id())->booked_tasks()->attach($request->validated()['id'], ['booked_at' => Carbon::now()]);

        return redirect()->route('task-management.index')->with('success', 'Task berhasil di booking');
    }

    public function revokeBooking(RevokeBookingValidation $request)
    {
        User::find(auth()->id())->booked_tasks()->detach($request->validated()['id']);

        return redirect()->route('task-management.index')->with('success', 'Task yang di booking berhasil di revoke');
    }
}
