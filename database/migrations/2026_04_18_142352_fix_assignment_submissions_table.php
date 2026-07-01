<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('assignment_submissions', function (Blueprint $table) {

            if (!Schema::hasColumn('assignment_submissions', 'assignment_id')) {
                $table->unsignedBigInteger('assignment_id')->nullable();
            }

            if (!Schema::hasColumn('assignment_submissions', 'student_id')) {
                $table->unsignedBigInteger('student_id')->nullable();
            }

            if (!Schema::hasColumn('assignment_submissions', 'file')) {
                $table->string('file')->nullable();
            }

            if (!Schema::hasColumn('assignment_submissions', 'status')) {
                $table->string('status')->default('submitted');
            }

            if (!Schema::hasColumn('assignment_submissions', 'submitted_at')) {
                $table->timestamp('submitted_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignment_submissions', function (Blueprint $table) {
            //
        });
    }
};
