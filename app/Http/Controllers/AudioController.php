<?php

namespace App\Http\Controllers;

use App\Helpers\AudioHelper;
use App\Models\Audio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $audio = Audio::all();
        return view('audio', compact('audio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'audio' => 'required|mimes:mp3,wav,aac,flac,ogg'
        ]);

        if($request->hasFile('audio')){
            $audio = $request->file('audio');
            // dd($audio);
            
            $audioPath = $audio->store('uploads/audio', 'public');
            
            $fullAudioPath = $audio->move('uploads/audio', $audio->getClientOriginalName());

            // Get the duration of the audio file
            $duration = AudioHelper::getAudioDuration($fullAudioPath);

            if ($duration === null) {
                return Redirect::back()->with('error', 'Could not determine the audio duration.');
            }
            
            // Save audio information to the database
            $audioRecord = new Audio();
            $audioRecord->name = $audio->getClientOriginalName();
            $audioRecord->path = $audioPath;
            $audioRecord->duration = $duration;

            // dd($request->all());
            try{
                $audioRecord->save();
                return Redirect::back()->with('success', 'Audio uploaded successfully');
            }catch(Exception $e){
                return Redirect::back()->with('error' , $e->getMessage());
            }
        }

        return Redirect::back()->with('error', 'No audio file was uploaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $audio = Audio::find($id);
        if(!$audio) return Redirect::back()->with('error', 'Audio file not found!');

        try{
            $audio->delete();
            return Redirect::back()->with('success', 'Audio file has been deleted!');
        }catch(Exception $e){
            return Redirect::back()->with('error', $e->getMessage());
        }

    }
}
