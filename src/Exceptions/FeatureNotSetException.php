<?php 

namespace Zahzah\LaravelFeature\Exceptions;

class FeatureNotSetException extends \Exception
{
    public function __construct() {
        parent::__construct("Feature not set.");
    }
}