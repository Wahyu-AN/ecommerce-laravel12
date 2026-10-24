<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasUniqueSlug
{
    public static function bootHasUniqueSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug($model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name')) {
                $model->slug = $model->generateUniqueSlug($model->name);
            }
        });
    }

    /**
     * Buat slug unik dari sebuah nilai.
     */
    public function generateUniqueSlug(string $value): string
    {
        $base = Str::slug($value);
        $slug = $base;
        $i = 1;

        while (static::where('slug', $slug)
            ->where('id', '!=', $this->getKey())
            ->exists()) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}