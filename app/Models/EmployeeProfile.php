<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'profile_picture',
        'manager_profile_id',
        'branch',
        'link',
        'position',
        'educationback',
        'keyskills',
    ];

    /**
     * Get the manager that owns the employee.
     */
    public function managerProfile()
    {
        return $this->belongsTo(ManagerProfile::class);
    }
}
