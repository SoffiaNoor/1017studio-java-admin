<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage360 extends Model
{
    use HasFactory;

    protected $table = 'project_type_image_360';

    protected $fillable = [
        'id_project_type',
        'image_360',
    ];

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class, 'id_project_type');
    }

    public function project()
    {
        return $this->projectType->projectTypes; // Assuming 'projectTypes' is the correct relationship method
    }
}
