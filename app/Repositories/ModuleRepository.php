<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getModuleCourse(int $courseID)
    {
        return $this->entity->where('course_id', $courseID)->get();
    }

    public function createModules(int $courseID, array $array)
    {
        $array['course_id'] = $courseID;

        return $this->entity->create($array);
    }

    public function getModuleByCourse(int $courseID, $id)
    {
        return $this->entity->where([
            ['course_id', '=', $courseID],
            ['uuid', '=', $id]
        ])->firstOrFail();
    }

    public function getModuleByUuid(string $id)
    {
        return $this->entity->where([
            ['uuid', '=', $id]
        ])->firstOrFail();
    }

    public function updateModuleByUuid(int $courseID, string $id, array $array)
    {
        $module = $this->getModuleByUuid($id);

        $array['course_id'] = $courseID;

        return $module->update($array);
    }

    public function deleteModuleByUuid(string $id)
    {
        $module = $this->getModuleByUuid($id);

        return $module->delete();
    }
}
