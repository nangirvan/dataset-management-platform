<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevokeBookingValidation;
use App\Http\Requests\BookingValidation;
use App\Http\Requests\CreateTaskValidation;
use App\Http\Requests\DownloadTaskValidation;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('users')->where('id_uploader', auth()->id())->orderBy('uploaded_at', 'desc')->get();
        
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
        $file_name = ($request->validated()['name'] == null) ? $request->dataset->getClientOriginalName() : $request->validated()['name'].'.'.$request->dataset->extension();
        $data = [
            'id_uploader' => auth()->id(),
            'name' => $file_name,
            'file_path' => $request->dataset->storeAs('datasets/'.auth()->id(), $file_name, 'public'),
            'file_size' => $request->dataset->getSize(),
            'uploaded_at' => Carbon::now(),
        ];

        Task::create($data);
        
        return redirect()->route('task-management.index')->with('success', 'Dataset uploaded');
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

        return redirect()->route('task-management.index')->with('success', 'Task deleted');
    }

    public function booking(BookingValidation $request)
    {
        User::find(auth()->id())->booked_tasks()->attach($request->validated()['id'], ['booked_at' => Carbon::now()]);

        return redirect()->route('task-management.index')->with('success', 'Task booked');
    }

    public function revokeBooking(RevokeBookingValidation $request)
    {
        User::find(auth()->id())->booked_tasks()->detach($request->validated()['id']);

        return redirect()->route('task-management.index')->with('success', 'Task revoked');
    }

    public function downloadDataset(DownloadTaskValidation $request)
    {
        return Storage::download('public/'.Task::find($request->validated()['id'])->file_path);
    }
}
