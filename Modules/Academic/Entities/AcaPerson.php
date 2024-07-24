<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaPerson extends Model
{
    use HasFactory;

    protected $table = 'people';

    public function teacher()
    {
        return $this->hasOne(AcaTeacher::class, 'person_id');
    }

    public function student()
    {
        return $this->hasOne(AcaStudent::class, 'person_id');
    }
}
