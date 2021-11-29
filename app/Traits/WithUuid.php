<?php

namespace App\Traits;

use Ramsey\Uuid\Nonstandard\UuidV6;

trait WithUuid
{
    public static function boot()
    {
        parent::boot();

        self::creating(fn ($model) => $model->{$model->getKeyName()} = (string) UuidV6::uuid6());
    }

    public function initializeHasUuid()
    {
        $this->incrementing = false;
        $this->keyType = 'string';
    }
}