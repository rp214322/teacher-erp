<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'teacher', 'student'])->change();
            $table->string('middle_name')->nullable()->after('first_name');
            if (!Schema::hasColumn('users', 'phone1')) {
                $table->string('phone1')->nullable()->after('phone');
            }
            $table->string('phone2')->nullable()->after('phone1');
            $table->string('parent_phone_no')->nullable()->after('phone2');
            $table->string('enrollment_no')->nullable()->after('parent_phone_no');
            $table->date('admission_date')->nullable()->after('enrollment_no');
            $table->date('dob')->nullable()->after('admission_date');
            $table->text('address')->nullable()->after('dob');
            $table->string('city')->nullable()->after('address');
            $table->date('date_of_joining')->nullable()->after('city');
            $table->string('qualification')->nullable()->after('date_of_joining');
            $table->foreignId('program_id')->nullable()->constrained('programs')->cascadeOnDelete()->after('qualification');
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->cascadeOnDelete()->after('program_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'customer'])->default('customer')->change();
            $table->dropColumn('middle_name');
            $table->string('phone')->nullable()->change();
            $table->dropColumn(['phone2', 'parent_phone_no', 'enrollment_no', 'admission_date', 'dob', 'address', 'city', 'date_of_joining', 'qualification', 'program_id', 'subject_id']);
        });
    }
}
