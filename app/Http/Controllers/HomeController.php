<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $videos = Video::paginate(5);
        return view('home')->with(['videos' => $videos]);
    }

    public function video($id)
    {

        $video = Video::findOrFail($id);


        $lastVideos = Video::orderBy('id', 'desc')->take(3)->get();

        return view('single')->with(['video' => $video, 'lastVideos' => $lastVideos]);
    }


    public function tags()
    {
        $tags = Tag::all();

        return view('tags')->with(['tags' => $tags]);
    }

    public function showTags(Request $request)
    {

        $id = $request->get('id');
        $tags = Tag::where('id', $id)->with('videos')->get();
        $video = [];
        foreach ($tags as $tag) {

            array_push($video, $tag->videos);
        }


        return response()->json(['ok' => $video]);

    }
    public function search(Request $request){

         $search=$request->get('q');
         $video=Video::where ('name', 'LIKE', "%" . $search . "%")->get();

         return view('search',compact('video'));
    }
}
