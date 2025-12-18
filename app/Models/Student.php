<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_class_id',
        'school_major_id',
        'identification_number',
        'name',
        'phone_number',
        'gender',
        'school_year_start',
        'school_year_end',
    ];

    public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class, 'school_class_id');
}

public function schoolMajor()
{
    return $this->belongsTo(SchoolMajor::class, 'school_major_id');
}

    /**
     * Get the cash transactions relationship.
     */
    public function cashTransactions(): HasMany
    {
        return $this->hasMany(CashTransaction::class);
    }

    /**
     * Scope a query to search for data across multiple columns.
     */
    public function scopeSearch(Builder $query, string $searchQuery): void
    {
        $query->where('identification_number', 'like', "%{$searchQuery}%")
            ->orWhere('name', 'like', "%{$searchQuery}%")
            ->orWhere('school_year_start', 'like', "%{$searchQuery}%")
            ->orWhere('school_year_end', 'like', "%{$searchQuery}%")
            ->orWhereHas('schoolClass', function (Builder $schoolClassQuery) use ($searchQuery) {
                $schoolClassQuery->where('name', 'like', "%{$searchQuery}%");
            })
            ->orWhereHas('schoolMajor', function (Builder $schoolMajorQuery) use ($searchQuery) {
                $schoolMajorQuery->where('name', 'like', "%{$searchQuery}%");
            });
    }
}
