<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{

    private function getObject($announcementID){

        $announcement = Announcement::find($announcementID);

        if (!$announcement) {
            abort(404, 'Announcement not found');
        }
    
        return $announcement;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $announcements = Announcement::all();
        return response()->json($announcements,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title'=>'required',
            'description'=>'required'
        ]);

        $announcement = $request->user()->announcements()->create($validated);

        return response()->json($announcement,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $announcementID)
    {
        $announcement = $this->getObject($announcementID);

        return response()->json($announcement,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $announcementID)
    {
       
        $announcement = $this->getObject($announcementID);

        $validated = $request->validate([
            'title'=>'required',
            'description'=>'required'
        ]);

        $announcement->update($validated);
        return response()->json($validated,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $announcementID)
    {
        $announcement = $this->getObject($announcementID);
        $announcement->delete();
        return response()->json(['message'=>'announcement delete'],200);
    }
}
