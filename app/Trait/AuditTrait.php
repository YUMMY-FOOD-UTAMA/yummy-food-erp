<?php

namespace App\Trait;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AuditTrait
{
    public static function bootAuditBy()
    {
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
            if (!$model->isDirty('updated_by')) {
                $model->created_by = auth()->user()->id;
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });

        static::deleting(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });

        static::restoring(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = auth()->user()->id;
            }
        });
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name', 'email')->withDefault();
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by')->select('id', 'name', 'email')->withDefault();
    }

    public function createdAt()
    {
        return $this->created_at->setTimezone(Auth::user()->timezone)->format('Y-m-d H:i:s');
    }

    public function createdAtOnlyDate()
    {
        return $this->created_at->setTimezone(Auth::user()->timezone)->format('Y-m-d');
    }

    public function updatedAt()
    {
        return $this->created_at->setTimezone(Auth::user()->timezone)->format('Y-m-d H:i:s');
    }

    public function updatedAtOnlyDate()
    {
        return $this->created_at->setTimezone(Auth::user()->timezone)->format('Y-m-d');
    }
}
