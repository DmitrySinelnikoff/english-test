<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function questions()
    {
        return $this->hasMany(TestQuestion::class);
    }

    public function completeTests()
    {
        $questionsCompleteCount = $this->questions()->where('result', '<>', 0)->count();
        return $questionsCompleteCount;
    }
}
