<?php

namespace Modules\Health\Entities;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Health\Database\factories\HealDoctorFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HealDoctor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'person_id',
        'user_id',
        'doctor_code'
    ];

    public function person(): HasOne
    {
        return $this->hasOne(Person::class, 'id', 'person_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
