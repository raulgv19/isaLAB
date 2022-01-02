<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $activities = Activity::all();
        
        $bookedActivities = DB::table('activities')
            ->join('activity_user', 'activities.id', '=', 'activity_user.activity_id')
            ->where('activity_user.user_id', $user->id)
            ->get();

        //dd($test);
        
        return view('layouts.dashboard', compact('user','activities','bookedActivities'));
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
        //
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

    public static function alreadyBooked($activityID,$userID){
        $bookedActivities = DB::table('activities')
            ->join('activity_user', 'activities.id', '=', 'activity_user.activity_id')
            ->where('activity_user.user_id', $userID)
            ->where('activity_user.activity_id', $activityID)
            ->get();
        
        if(count($bookedActivities)){
            return true;
        }
        else{
            return false;
        }
 
    }

    public static function isAdmin($userID){

        $user = User::find($userID);

        $roleUser = DB::table('role_user')->where('user_id',$user->id)->first();

        $role = Role::find($roleUser->role_id);

        
        if($role->role_name === 'Admin'){
            return true;
        }
        else{
            return false;
        }
 
    }

    public static function isClient($userID){

        $user = User::find($userID);

        $roleUser = DB::table('role_user')->where('user_id',$user->id)->first();

        $role = Role::find($roleUser->role_id);

        
        if($role->role_name === 'Socio'){
            return true;
        }
        else{
            return false;
        }
 
    }
}
