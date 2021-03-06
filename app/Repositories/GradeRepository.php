<?php

namespace App\Repositories;

use App\User;
use App\Models\Grade;
use App\Filters\GradeFilters;
use Carbon\Carbon;

class GradeRepository
{
    public function model()
    {
        return app(Grade::class);
    }

    public function list(User $user, GradeFilters $filters) {
        $items = $this->model()->filter($filters)->paginate();
        $items->transform(function ($item) use ($filters) {
            return $filters->transform($item);
        });
        return $items;
    }

    public function single($id, GradeFilters $filters = null) {
        $q = $this->model();
        if ($filters) {
            $q = $q->filter($filters);
        }
        return $filters ? $filters->transform($q->findOrFail($id)) : $q->findOrFail($id);
    }

    public function delete($id) {
        return $this->model()->where('id', $id)->delete();
    }

    public function create($opts) {
        return $this->model()->create($opts);
    }

    public function update($id, $opts = []) {
        $item = $this->model()->findOrFail($id);
        $item->fill($opts);
        $item->save();
        return $item;
    }

    public function count(GradeFilters $filters)
    {
        return $this->model()->filter($filters)->select('id', DB::raw('count(*) as total'))->count();
    }

    public function total(int $student_takes_course_id) {
        return $this->model()->total($student_takes_course_id);
    }
}