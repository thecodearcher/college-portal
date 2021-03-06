<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends BaseModel
{
    public const ADMIN = 'admin';
    public const STAFF = 'staff';
    public const STUDENT = 'student';
    public const SCHOOL_OWNER = 'school-owner';
    public const HOD = 'hod';
    public const DEAN = 'dean';
    public const PROSPECT = 'prospect';

    protected $fillable = [ 'name', 'display_name' ];

    public function isAdmin() {
        return $this->name == self::ADMIN;
    }
}
