<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'profile_picture',
        'branch',
        'specify_branch',
        'position',
        'educbackground',
        'keyskills',
        'link'
    ];

    /**
     * Get the employees for the manager.
     */
    public function employeeProfiles()
    {
        return $this->hasMany(EmployeeProfile::class, 'manager_profile_id');
    }
}
