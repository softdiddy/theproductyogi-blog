<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuids
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootHasUuids()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the casts array with the uuid cast included.
     *
     * @return array
     */
    public function getCasts()
    {
        return array_merge(parent::getCasts(), [
            $this->getKeyName() => 'string',
        ]);
    }
}
