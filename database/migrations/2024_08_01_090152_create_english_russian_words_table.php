<?php

use App\Models\EnglishWord;
use App\Models\RussianWord;
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
        Schema::create('english_russian_words', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(EnglishWord::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(RussianWord::class)->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('english_russian_words');
    }
};
