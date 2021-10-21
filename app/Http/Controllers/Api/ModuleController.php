<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModule;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index(string $course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Controllers\Api\StoreUpdateModule $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateModule $request)
    {
        $module = $this->moduleService->createModules($request->validated());

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $course, string $id)
    {
        $module = $this->moduleService->getModulesByCourse($course, $id);

        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Controllers\Api\StoreUpdateModule $request
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
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $course = $this->moduleService->deleteModule($id);

        return response()->json([], 204);
    }
}
