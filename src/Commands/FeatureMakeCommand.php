<?php

namespace Zahzah\LaravelFeature\Commands;

use Illuminate\Console\Command;
use Zahzah\LaravelFeature\LaravelFeature;

class FeatureMakeCommand extends Command{

    /**
     * The name and signature of the console command.
     * @var string
    **/
    protected $signature = 'feature:make {name}';

    /**
     * The console command description.
     * @var string
     **/
    protected $description = 'Make new feature';
    

    public function handle(){
        $feature_name = $this->argument('name');
        
        LaravelFeature::useMasterFeature()->add($feature_name);
    }
}
