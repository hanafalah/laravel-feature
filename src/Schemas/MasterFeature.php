<?php

namespace Hanafalah\LaravelFeature\Schemas;

use Hanafalah\LaravelFeature\{
    Supports\BaseLaravelFeature
};
use Hanafalah\LaravelSupport\Contracts\DataManagement;

class MasterFeature extends BaseLaravelFeature implements DataManagement
{
    public function booting(): self
    {
        static::$__class = $this;
        static::$__model = $this->{$this->__entity . "Model"}();
        return $this;
    }

    protected array $__guard   = ['id', 'parent_id', 'name'];
    protected array $__add     = ['name'];
    protected string $__entity = 'MasterFeature';
    protected $__feature;

    protected function booting(): void
    {
        parent::booting();
        $this->__feature = self::$__model;
    }

    /**
     * Add a new API access or update the existing one if found.
     *
     * The given attributes will be merged with the existing API access.
     *
     * @param array $attributes The attributes to be added to the API access.
     *
     * @return \Illuminate\Database\Eloquent\Model The API access model.
     */
    public function addOrChange(?array $attributes = []): self
    {
        $this->updateOrCreate($attributes);
        $this->__feature = self::$__model;
        $condition = $this->isRecentlyCreated() || isset($attributes['addFeatureVersion']);
        if ($condition) $this->addFeatureVersion($attributes['addFeatureVersion'] ?? config('module-version.application.version_pattern'));
        return $this;
    }

    /**
     * Add a new feature version to the master feature.
     *
     * @param string $version The version name.
     *
     * @return self The current instance.
     */
    public function addFeatureVersion($version): self
    {
        $model = self::$__model;
        $this->childSchema(ModuleVersion::class, function ($class) use ($version, $model) {
            $class->add([
                'model_id'   => $model->getKey(),
                'model_type' => $model->getMorphClass(),
                'name'       => $version
            ]);
        });
        return $this;
    }

    public function remove($featureId = null): self
    {
        $featureId ??= $this->__feature->getKey();
        if (isset($featureId)) $this->MasterFeatureModel()->delete($featureId);
        return $this;
    }

    //GETTER SECTION
    /**
     * Retrieves a collection of features based on the given conditions.
     *
     * @param mixed|null $conditionls The conditions to filter the features. Default is null.
     * @return \Illuminate\Database\Eloquent\Collection The collection of features.
     */
    public function getFeatureList($conditionls = null): \Illuminate\Database\Eloquent\Collection
    {
        return $this->MasterFeatureModel()->conditionals($conditionls)->get();
    }
    //END GETTER SECTION
}
