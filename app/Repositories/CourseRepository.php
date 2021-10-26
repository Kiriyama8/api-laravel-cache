<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    protected $entity;

    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
        return Cache::rememberForever('courses',  function () {
            return $this->entity->with('modules.lessons')->get();
        });
    }

    public function createCourses(array $array)
    {
        return $this->entity->create($array);
    }

    public function getCourseByUuid(string $id, bool $loadRelationships = true)
    {
        $query = $this->entity->where('uuid', $id);

        if ($loadRelationships) {
            $query->with('modules.lessons');
        }

        return $query->firstOrFail();
    }

    public function updateCourseByUuid(string $id, array $array)
    {
        $course = $this->getCourseByUuid($id, false);

        Cache::forget('courses');

        return $course->update($array);
    }

    public function deleteCourseByUuid(string $id)
    {
        $course = $this->getCourseByUuid($id, false);

        Cache::forget('courses');

        return $course->delete();
    }
}
