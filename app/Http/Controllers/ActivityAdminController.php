<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();
        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->get('name'));
        $data = ([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'duration' => $request->duration,
            'schedule' => $request->schedule,
            'instructor_name' => $request->instructor_name,
        ]);

        Activity::create($data);

        return redirect('/admin/activities/')->with('success', 'Actividad creada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer',
            'duration' => 'required|integer',
            'schedule' => 'required',
            'instructor_name' => 'required',
        ]);

        $activity->name = $request->name;
        $activity->capacity = $request->capacity;
        $activity->duration = $request->duration;
        $activity->schedule = $request->schedule;
        $activity->instructor_name = $request->instructor_name;
        $activity->save();

        $activity->fill($request->all())->save();

        return redirect('/admin/activities/')->with('success', 'Actividad actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect('/admin/activities/')->with('success', 'Actividad eliminada correctamente');
    }
}
