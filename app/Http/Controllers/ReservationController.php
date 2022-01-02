<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request->all());
        $user = User::find($request['userID']);
        $activity = Activity::where('id', $request['activityID'])->first();

        $user->activities()->attach($activity);


        $activityCapacity = Activity::find($request['activityID']);
        $activityCapacity->decrement('capacity');

        // Decrease the number of available spots

        return redirect('/dashboard')->with('success', 'Actividad reservada correctamente');
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
       $bookedActivities = DB::table('activity_user')
       ->where('activity_user.activity_id', $id)
       ->delete();

       $activityCapacity = Activity::find($id);
        $activityCapacity->increment('capacity');

       
        return redirect('/dashboard')->with('success', 'Actividad cancelada correctamente');
    }
}
