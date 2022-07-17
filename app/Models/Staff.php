<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'staffs';

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function designation() {
        return $this->belongsTo(Designation::class);
    }
}
