<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->string('password');
            $table->string('cellphone');

        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('id_owner');
            $table->integer('id_resident');
        });

        Schema::create('unitpeoples', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->string('name');
            $table->date('birthdate');
        });

        Schema::create('condominium', function (Blueprint $table) {
            $table->id();
            $table->integer('id_trustee');
            $table->string('name');
            $table->string('email');
            $table->string('telephone');
            $table->integer('numberOfApartments');
            $table->integer('numberOfCommercialPoints');
        });

        Schema::create('billets', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->string('title');
            $table->string('fileurl');
        });

        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->integer('number');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
            $table->integer('cep');
        });

        Schema::create('warnings', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->string('title');
            $table->string('status')->default('IN_REVIEW'); // IN_REVIEW, RESOLVED
            $table->date('dateCreated');
            $table->text('photos');
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->integer('allowed')->default(1);
            $table->string('title');
            $table->string('cover');
            $table->string('days'); //0,1,2,3,4,5,6
            $table->time('start_time');
            $table->time('end_time');
        });

        Schema::create('areaDisabledDays', function (Blueprint $table) {
            $table->id();
            $table->integer('id_area');
            $table->date('day');
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->integer('id_area');
            $table->datetime('reservation_date');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('units');
        Schema::dropIfExists('unitpeoples');
        Schema::dropIfExists('condominium');
        Schema::dropIfExists('billets');
        Schema::dropIfExists('address');
        Schema::dropIfExists('warnings');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('areaDisabledDays');
        Schema::dropIfExists('reservations');
    }
};
