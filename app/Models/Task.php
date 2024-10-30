<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    public const IMAGE_PATH = 'images/tasks';

    protected $fillable = [
        'title',
        'description',
    ];

    public function deleteImage(): void
    {
        if (!empty($this->image) && Storage::fileExists($this->image)) {
            Storage::delete($this->image);
            $this->image = null;
        }
    }
}
