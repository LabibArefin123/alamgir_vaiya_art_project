<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');

            $table->rememberToken();

            // ðŸ“± Contact
            $table->string('phone')->nullable();
            $table->string('phone_2')->nullable();

            // ðŸ–¼ Profile
            $table->string('profile_picture')->nullable();

            // ðŸ” Two Factor
            $table->boolean('two_factor_enabled')->default(0);
            $table->string('two_factor_code', 10)->nullable();
            $table->timestamp('two_factor_expires_at')->nullable();

            // â± Session
            $table->float('session_timeout')->default(5);

            // ðŸ›  Maintenance Mode
            $table->boolean('is_maintenance')->default(0);
            $table->string('maintenance_message')->nullable();

            // ðŸš« Ban System
            $table->boolean('is_banned')->default(0);

            $table->boolean('is_notifications')->default(0);
            $table->boolean('is_debugbar')->default(0);
            // ðŸŸ¢ Online Status
            $table->timestamp('last_seen')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
