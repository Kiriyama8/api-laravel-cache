<?php

namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    protected $entity;

    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getLessonsModule(int $moduleId)
    {
        return $this->entity->where('module_id', $moduleId)->get();
    }

    public function createNewLesson(int $moduleId, array $array)
    {
        $array['module_id'] = $moduleId;

        return $this->entity->create($array);
    }

    public function getLessonByModule(int $moduleId, string $identify)
    {
        return $this->entity->where([
                ['module_id', '=', $moduleId],
                ['uuid', '=', $identify]
            ])->firstOrfail();
    }

    public function getLessonByUuid(string $identify)
    {
        return $this->entity->where('uuid', $identify)->firstOrfail();
    }

    public function updateLessonByUuid(int $moduleId, string $identify, array $array)
    {
        $lesson = $this->getLessonByUuid($identify);

        $array['module_id'] = $moduleId;

        return $lesson->update($array);
    }

    public function deleteLessonByUuid(string $identify)
    {
        $lesson = $this->getLessonByUuid($identify);

        return $lesson->delete();
    }
}
