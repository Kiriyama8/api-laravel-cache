<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCourse;
use App\Http\Resources\CourseResource;
use App\Http\Resources\StoreUpdateModule;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $courses = $this->courseService->getAllCourses();

        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateCourse $request
     * @return CourseResource
     */
    public function store(StoreUpdateCourse $request)
    {
        $course = $this->courseService->createCourses($request->validated());

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CourseResource
     */
    public function show($id)
    {
        $course = $this->courseService->getCourse($id);

        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCourse $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateCourse $request, $id)
    {
        $this->courseService->updateCourse($id, $request->validated());

        return response()->json(['message' => 'Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $course = $this->courseService->deleteCourse($id);

        return response()->json([], 204);
    }
}
