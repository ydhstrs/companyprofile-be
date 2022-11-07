<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\UpdateHomeRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Home;
use App\Services\ImageService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $home = Home::all();

        return response()->json([
          'home' => $home  
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\Post\StorePostRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try {
            if ($request->hasFile('image') === false) {
                return response()->json(['error' => 'There is no image to upload.'], 400);
            }

            $home = new Home;

            (new ImageService)->updateImage($home, $request, '/images/home/', 'store');

            $home->title = $request->get('title');
            $home->location = $request->get('location');
            $home->description = $request->get('description');

            $home->save();

            return response()->json('New post created', 200);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Something went wrong? Please try again.' . $e->getMessage()], 400);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Post\UpdatePostRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeRequest $request, $id)
    {
        try {
            $home = Home::findOrFail($id);
    if ($request->file('image')->isValid()) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = 'images/posts/' ;
            $file->move($destinationPath,$fileName);
            $home->image = $fileName;
        }
            $home->name = $request->name;
            $home->description = $request->description;
            $home->address = $request->address;
            $home->contact = $request->contact;

            $home->save();

            return response()->json('Success' . $id . ' was updated!', 200);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Something went wrong? Please try again.' . $e->getMessage()], 400);
        }
    }
}
