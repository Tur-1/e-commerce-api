<?php

namespace App\Modules\Admins\Database\migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Modules\Admins\Enums\AdminGenderEnum;
use App\Modules\Admins\Enums\AdminStatusEnum;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->enum('gender', array_column(AdminGenderEnum::cases(), 'value'))
                ->default(AdminGenderEnum::Female->value);
            $table->enum('status', array_column(AdminStatusEnum::cases(), 'value'))
                ->default(AdminStatusEnum::ACTIVE->value);
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
        Schema::dropIfExists('admins');
    }
};
