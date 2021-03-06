<?php

namespace App\Repositories;

use App\User;
use App\Models\Staff;
use App\Filters\StaffFilters;
use Carbon\Carbon;

class StaffRepository
{
    public function model()
    {
        return app(Staff::class);
    }

    public function list(User $user, StaffFilters $filters) {
        $items = $user->viewableStaff()->filter($filters)->paginate();
        $items->transform(function ($item) use ($filters) {
            return $filters->transform($item);
        });
        return $items;
    }

    public function single($id, StaffFilters $filters = null) {
        $q = $this->model();
        if ($filters) {
            $q = $q->filter($filters);
        }
        return $filters ? $filters->transform($q->findOrFail($id)) : $q->findOrFail($id);
    }

    public function delete($id) {
        $single = $this->model()->where('id', $id)->first();
        return $single->delete();
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

    public function count(StaffFilters $filters)
    {
        return $this->model()->filter($filters)->select('id', DB::raw('count(*) as total'))->count();
    }
}