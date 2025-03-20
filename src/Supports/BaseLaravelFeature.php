<?php

namespace Zahzah\LaravelFeature\Supports;

use Zahzah\LaravelSupport\Supports\PackageManagement;
use Zahzah\LaravelFeature\Concerns;

class BaseLaravelFeature extends PackageManagement{
    use Concerns\HasSetupFeature;
    use Concerns\FinderTrait;

    /** @var array */
    protected $__feature_config = [];

}

