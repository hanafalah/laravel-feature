<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Zahzah\LaravelFeature\Models\Feature\MasterFeature;

return new class extends Migration
{
   use Zahzah\LaravelSupport\Concerns\NowYouSeeMe;

    private $__table;

    public function __construct(){
        $this->__table = app(config('database.models.MasterFeature', MasterFeature::class));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $table_name = $this->__table->getTable();
        if (!$this->isTableExists()){
            Schema::create($table_name, function (Blueprint $table) {
                $table->id();
                $table->string('uuid',255)->unique()->nullable(false);
                $table->string('name',255)->nullable(false);
                $table->json('props')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasColumn($table_name,'parent_id')){
            Schema::table($table_name,function (Blueprint $table) use ($table_name){
                $table->foreignIdFor($this->__table::class,'parent_id')
                      ->after('id')->nullable()->index()->constrained($table_name)
                      ->cascadeOnUpdate()->restrictOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->__table->getTable());
    }
};
