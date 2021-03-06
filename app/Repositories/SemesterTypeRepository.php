<?php

namespace App\Repositories;

use App\User;
use App\Models\SemesterType;
use App\Filters\SemesterTypeFilters;
use Carbon\Carbon;

class SemesterTypeRepository
{
    public function model()
    {
        return app(SemesterType::class);
    }

    public function types(User $user, SemesterTypeFilters $filters) {
        $items = $this->model()->filter($filters)->paginate();
        $items->transform(function ($item) use ($filters) {
            return $filters->transform($item);
        });
        return $items;
    }

    public function type($id, SemesterTypeFilters $filters = null) {
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

    public function count(SemesterTypeFilters $filters)
    {
        return $this->model()->filter($filters)->select('id', DB::raw('count(*) as total'))->count();
    }
}