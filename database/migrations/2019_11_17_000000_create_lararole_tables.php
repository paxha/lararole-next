<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLararoleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (config('lararole.providers') as $key => $provider) {
            Schema::create("${key}_modules", function (Blueprint $table) use ($key) {
                $table->id();
                $table->unsignedBigInteger("module_id")->nullable();
                $table->string('name');
                $table->string('slug')->unique();
                $table->timestamps();

                $table->foreign('module_id')->references('id')->on("${key}_modules")->onDelete('cascade');
            });

            Schema::create("${key}_roles", function (Blueprint $table) {
                $table->id('id');
                $table->string('name');
                $table->string('slug')->unique();
                $table->timestamps();
            });

            Schema::create("${key}_permissions", function (Blueprint $table) {
                $table->id('id');
                $table->string('name');
                $table->timestamps();
            });

            Schema::create("${key}_module_role", function (Blueprint $table) use ($key) {
                $table->id('id');
                $table->unsignedBigInteger('module_id');
                $table->unsignedBigInteger('permission_id');
                $table->unsignedBigInteger('role_id');
                $table->timestamps();

                $table->foreign('role_id')->references('id')->on("${key}_roles")->onDelete('cascade');
                $table->foreign('permission_id')->references('id')->on("${key}_permissions")->onDelete('cascade');
                $table->foreign('module_id')->references('id')->on("${key}_modules")->onDelete('cascade');
            });

            Schema::create("${key}_role_user", function (Blueprint $table) use ($provider, $key) {
                $table->id('id');
                $table->unsignedBigInteger('role_id');
                $table->unsignedBigInteger('user_id');
                $table->timestamps();

                $table->foreign('role_id')->references('id')->on("${key}_roles")->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on(app($provider['model'])->getTable())->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (config('lararole.providers') as $key => $provider) {
            Schema::dropIfExists("${key}_role_user");
            Schema::dropIfExists("${key}_module_role");
            Schema::dropIfExists("${key}_permissions");
            Schema::dropIfExists("${key}_roles");
            Schema::dropIfExists("${key}_modules");
        }
    }
}
