<?php

use Hanafalah\LaravelFeature\Models as FeatureModels;
use Hanafalah\LaravelFeature\Commands as FeatureCommands;

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
