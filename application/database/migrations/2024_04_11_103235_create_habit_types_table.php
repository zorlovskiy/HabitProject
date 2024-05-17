<?php

use App\Models\HabitType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tablename;

    public function __construct()
    {
        $this->tablename = (new HabitType())->getTable();
    }

    public function up(): void
    {
        if (!Schema::hasTable($this->tablename)) {
            Schema::create($this->tablename, function (Blueprint $table) {
                $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));
                $table->string('name');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tablename);
    }
};
