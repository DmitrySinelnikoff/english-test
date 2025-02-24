<?php

use App\Models\User;
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
        Schema::create('word_views', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("english_word_id");
            $table->string("session_id");
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string("ip");
            $table->string("agent");
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
        Schema::dropIfExists('word_views');
    }
};
