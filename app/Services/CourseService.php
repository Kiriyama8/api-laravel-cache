<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

class CourseService
{
    protected $repository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    public function getAllCourses()
    {
        return $this->repository->getAllCourses();
    }

    public function createCourses(array $array)
    {
        return $this->repository->createCourses($array);
    }

    public function getCourse(string $id)
    {
        return $this->repository->getCourseByUuid($id);
    }
}
