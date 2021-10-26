<?php

namespace App\Services;

use App\Repositories\{
    CourseRepository,
    ModuleRepository
};

class ModuleService
{
    protected $moduleRepository;
    protected $courseRepository;

    public function __construct(
        ModuleRepository $moduleRepository,
        CourseRepository $courseRepository
    ) {
        $this->moduleRepository = $moduleRepository;
        $this->courseRepository = $courseRepository;
    }

    public function getModulesByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->getModuleCourse($course->id);
    }

    public function createModules(array $array)
    {
        $course = $this->courseRepository->getCourseByUuid($array['course']);

        return $this->moduleRepository->createModules($course->id, $array);
    }

    public function getModuleByCourse(string $course, string $id)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->moduleRepository->getModuleByCourse($course->id, $id);
    }

    public function updateModule(string $id, array $array)
    {
        $course = $this->courseRepository->getCourseByUuid($array['course']);

        return $this->moduleRepository->updateModuleByUuid($course->id, $id, $array);
    }

    public function deleteModule(string $id)
    {
        return $this->moduleRepository->deleteModuleByUuid($id);
    }
}
