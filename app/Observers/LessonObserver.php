<?php

namespace App\Observers;

use App\Models\Lesson;
use Illuminate\Support\Str;

class LessonObserver
{
    /**
     * Handle the Course "creating" event.
     *
     * @param Lesson $lesson
     * @return void
     */
    public function creating(Lesson $lesson)
    {
        $lesson->uuid = (string) Str::uuid();
    }
}
