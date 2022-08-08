<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained('admins', 'id')->cascadeOnDelete();
            $table->string('name');
            $table->string('certificate')->nullable();
            $table->string('job');
            $table->string('education');
            $table->foreignId('location_id')->nullable()->constrained('countries', 'id')->cascadeOnDelete();
            $table->string('skills');
            $table->string('experience');
            $table->string('image')->nullable();
            $table->boolean('isactive')->default(0);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('teachers');
    }
}
