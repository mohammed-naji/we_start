<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 1,
            'message' => 'Done',
            'data' => Course::latest('id')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return 'ffff';
        $imgname = time().rand().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('/uploads'), $imgname);

        $course = Course::create([
            'title' => $request->title,
            'image' => $imgname,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);


        return response()->json([
            'status' => 1,
            'message' => 'Done',
            'data' => $course
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return response()->json([
            'status' => 1,
            'message' => 'Done',
            'data' => $course
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        File::delete(public_path('/uploads/'.$course->image));
        return response()->json([
            'status' => 1,
            'message' => 'Done',
            'data' => $course->delete()
        ], 200);

    }
}
