<?php 

use Zahzah\LaravelFeature\Models as FeatureModels;
use Zahzah\LaravelFeature\Commands as FeatureCommands;

return [
    'commands' => [
        FeatureCommands\FeatureMakeCommand::class,
        FeatureCommands\InstallMakeCommand::class
    ],
    'database' => [
        'models' => [
            'MasterFeature'   => FeatureModels\Feature\MasterFeature::class,
            'ModelHasFeature' => FeatureModels\Feature\ModelHasFeature::class
        ]
    ]
];