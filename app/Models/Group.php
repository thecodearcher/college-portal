<?php

namespace App\Models;

use App\Models\BaseModel;
use App\User;

/**
 * App\Models\Group
 *
 * @property int $id
 * @property int $name
 * @property int $owner_id
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Group whereName($value)
 * @mixin \Eloquent
 */
class Group extends BaseModel
{
    public function owner() {
        return $this->belongsTo(User::class);
    }
}
