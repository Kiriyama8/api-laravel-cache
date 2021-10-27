<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLesson;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($module)
    {
        $lessons = $this->lessonService->getLessonsByModule($module);

        return LessonResource::collection($lessons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateLesson $request
     * @param $module
     * @return LessonResource
     */
    public function store(StoreUpdateLesson $request, $module)
    {
        $module = $this->lessonService->createLessons($request->validated());

        return new LessonResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return LessonResource
     */
    public function show($module, $id)
    {
        $module = $this->lessonService->getLessonByModule($module, $id);

        return new LessonResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateLesson $request
     * @param string $module
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateLesson $request, string $module, $id)
    {
        $this->lessonService->updateLesson($id, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($module, $id)
    {
        $this->lessonService->deleteLesson($id);

        return response()->json([], 204);
    }
}
