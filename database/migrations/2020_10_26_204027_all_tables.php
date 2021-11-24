<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->string('section')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->string('term')->nullable();
            $table->string('college')->nullable();
            $table->string('certificate')->nullable();
            $table->string('specialty')->nullable();
            $table->string('subject_code')->nullable();
            $table->string('subject_name')->nullable();
            $table->string('reference')->nullable();
            $table->string('contact_hours')->nullable();
            $table->string('classification')->nullable();
            $table->string('days')->nullable();
            $table->string('times')->nullable();
            $table->string('building')->nullable();
            $table->string('hall')->nullable();
            $table->string('capacity')->nullable();
            $table->string('registered')->nullable();
            $table->string('rest')->nullable();
            $table->string('instructor_name')->nullable();
            $table->string('instructor_id')->nullable();

            $table->integer('day_index')->nullable();
            $table->time('start')->nullable();
            $table->time('end')->nullable();


            $table->timestamps();
        });

        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('computer_id');
            $table->string('name');
            $table->string('section')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            $table->text('string');
            $table->timestamps();

        });

        Schema::create('screens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('hall', 25)->nullable();
            $table->char('fingerprint', 80)->nullable();
            $table->timestamps();
        });

        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('screen_id');
            $table->foreignId('user_id')->nullable();
            $table->enum('type', [
                'text',
                'photo',
                'video',
                'pdf',
            ]);
            $table->string('value');
            $table->integer('announcements_number')->default(0);
            $table->dateTime('content_start')->nullable();
            $table->dateTime('content_end')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('screens');
        Schema::dropIfExists('instructors');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('users');
    }
}
