<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('member_id',4);
            $table->string('role',5)->default('user');
            $table->integer('engineer_type_id')->nullable();
            $table->string('name',50);
            $table->string('email',50)->unique();
            $table->string('mobile',15)->unique();
            $table->string('from_kaunia',15)->nullable();
            $table->string('complete_graduation',15)->nullable();
            $table->string('image',191)->nullable();
            $table->string('cover_photo',191)->nullable();
            $table->string('father_name',50)->nullable();
            $table->string('mother_name',50)->nullable();
            $table->string('about_me',500)->nullable();
            $table->string('date_of_birth',50)->nullable();
            $table->string('gender',50)->nullable();
            $table->string('present_address',255)->nullable();
            $table->string('permanent_address',255)->nullable();
            $table->string('profession',50)->nullable();
            $table->string('major_subject',100)->nullable();
            $table->text('profession_details')->nullable();
            $table->string('present_company',50)->nullable();
            $table->string('present_designation',50)->nullable();
            $table->text('extracurricular_activities')->nullable()->comment("Put on array");
            $table->text('hobbies_and_interest')->nullable()->comment("Put on array");
            $table->string('blood_group',10)->nullable();
            $table->string('national_id',50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('active')->comment('active,in-active');
            $table->string('approve_status',3)->default('no')->comment('yes/no/canceled');
            $table->string('menu_permission',3)->default('no')->comment('yes/no');
            $table->text('activity_access')->nullable()->comment('Pur activity ids in array');
            $table->boolean('online_status')->default(false);
            $table->string('last_logout_time',50)->nullable();
            $table->integer('approved_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        \App\Models\User::insert([
            'member_id' => 0001,
            'role' => 'admin',
            'name' => 'Mr. Admin',
            'email' => 'admin@gmail.com',
            'mobile' => '01737773393',
            'approve_status' => 'yes',
            'menu_permission' => 'yes',
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'created_at' => \Carbon\Carbon::now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
