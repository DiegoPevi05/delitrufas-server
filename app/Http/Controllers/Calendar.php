<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Specialist;
use App\Models\Meet;

class Calendar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $meetsQuery = Meet::query()
            ->join('users as user', 'meets.user_id', '=', 'user.id')
            ->join('specialists as specialist', 'meets.specialist_id', '=', 'specialist.id')
            ->join('users as specialist_user', 'specialist.user_id', '=', 'specialist_user.id') // Join with specialists' user table
            ->join('services', 'meets.service_id', '=', 'services.id')
            ->select(
                'meets.*', // Select all fields from the "meets" table
                'user.name as user_name', // Alias for user's name
                'specialist_user.name as specialist_name', // Alias for specialist's user name
                'services.name as service_name' // Alias for service's name
            );

        // Check if the name search parameter is provided
        $date = $request->query('date');
        if ($date) {
            // Apply the date filter to the query
            $meetsQuery->whereMonth('date_meet', $date);
        } else {
            $meetsQuery->whereMonth('date_meet', now()->month);
        }

        $user = $request->user();

        if ($user->role == User::ROLE_SPECIALIST) {

            $specialist = Specialist::where('user_id', $user->id)->first();
            $meetsQuery->where('specialist_id', $specialist->id);

        } else if ($user->role == User::ROLE_USER) {

            $meetsQuery->where('user_id', $user->id);
        }

        // Remove pagination
        $meetsQuery->orderBy('date_meet', 'asc');
        $meets = $meetsQuery->get(); // Fetch all results

        $searchParam = $date ? $date : '';

        // Return a view or JSON response as desired
        return view('calendars.index', compact('meets', 'searchParam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
