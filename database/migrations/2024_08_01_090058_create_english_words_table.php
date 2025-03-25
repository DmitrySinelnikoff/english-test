<?php

use App\Enums\StatusEnum;
use App\Models\WordStatus;
use App\Models\WordTag;
use Hamcrest\Core\HasToString;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english_words', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->string('transcription');
            $table->foreignIdFor(WordStatus::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('english_words');
    }
};
