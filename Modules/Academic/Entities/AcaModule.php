<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcaModule extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Academic\Database\factories\AcaModuleFactory::new();
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(AcaCourse::class, 'course_id');
    }

    public function themes(): HasMany
    {
        return $this->hasMany(AcaTheme::class, 'module_id');
    }
}
