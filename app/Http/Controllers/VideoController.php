<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $videos = Video::all();

        return view('video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('video.create')->with(['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'embed' => 'required',
            'file' => 'sometimes|max:5'
        ]);


        $video = Video::create($validatedData);

        foreach ($request->get('tag') as $tag) {
            $tag = Tag::findOrFail($tag);
            $video->tags()->attach($tag);
        }


        if ($request->hasFile('file')) {

            $images = $request->file('file');

            foreach ($images as $image) {

                $video->images()->create(['url' => $image->store('uploads', 'public')]);

            }
        }
        return redirect('video')->with('success', 'Video successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Video $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Video $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {


        $tags = $video->tags;
        return view('video.edit', compact(['video', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Video $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'embed' => 'required',
            'file' => 'sometimes|max:5'
        ]);
        $video->update([

            'name' => $request->get('name'),
            'desc' => $request->get('desc'),
            'embed' => $request->get('embed'),

        ]);

        $tags = $request->get('tag');

        if (count($tags) > 1) {

            foreach ($tags as $tag) {
                $tag = Tag::findOrFail($tag);
                $video->tags()->sync($tag);
            }
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Video $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return back();
    }
}
