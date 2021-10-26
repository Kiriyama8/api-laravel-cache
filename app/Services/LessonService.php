<?php

namespace App\Services;

use App\Repositories\{
    LessonRepository,
    ModuleRepository
};

class LessonService
{
    protected $lessonRepository;
    protected $moduleRepository;

    public function __construct(
        LessonRepository $lessonRepository,
        ModuleRepository $moduleRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->moduleRepository = $moduleRepository;
    }

    public function getLessonsByModule(string $module)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        return $this->lessonRepository->getLessonsModule($module->id);
    }

    public function createLessons(array $array)
    {
        $module = $this->moduleRepository->getModuleByUuid($array['module']);

        return $this->lessonRepository->createNewLesson($module->id, $array);
    }

    public function getLessonByModule(string $module, string $id)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        return $this->lessonRepository->getLessonByModule($module->id, $id);
    }

    public function updateLesson(string $id, array $array)
    {
        $module = $this->moduleRepository->getModuleByUuid($array['module']);

        return $this->lessonRepository->updateLessonByUuid($module->id, $id, $array);
    }

    public function deleteLesson(string $id)
    {
        return $this->lessonRepository->deleteLessonByUuid($id);
    }
}
