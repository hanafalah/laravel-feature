<?php

namespace Zahzah\LaravelFeature\Models\Feature;

use Zahzah\LaravelHasProps\Concerns\HasProps;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zahzah\LaravelSupport\Models\{
    BaseModel
};

class MasterFeature extends BaseModel{
    use SoftDeletes, HasProps;
    protected $table      = 'master_features';
    protected $fillable   = [
        'id','parent_id','name','uuid'
    ];

    //EIGER SECTION
    public function modelHasVersion(){return $this->morphOneModel('ModelHasVersion','model');}
    public function modelHasVersions(){return $this->morphManyModel('ModelHasVersion','model');}
    //END EIGER SECTION
}