<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModule;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(string $course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateModule $request
     * @return ModuleResource
     */
    public function store(StoreUpdateModule $request)
    {
        $module = $this->moduleService->createModules($request->validated());

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param string $course
     * @param string $id
     * @return ModuleResource
     */
    public function show(string $course, string $id)
    {
        $module = $this->moduleService->getModulesByCourse($course, $id);

        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateModule $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateModule $request, $id)
    {
        $this->moduleService->updateModule($id, $request->validated());

        return response()->json(['message' => 'Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $course = $this->moduleService->deleteModule($id);

        return response()->json([], 204);
    }
}
