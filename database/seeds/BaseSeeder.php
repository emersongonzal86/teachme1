<?php

use Faker\Factory as Faker;
use Faker\Generator;
use \Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseSeeder extends Seeder
{
    protected $total = 50;
    protected static $pool = array();

    public function run()
    {
        $this->createMultiple($this->total);
    }

    protected function createMultiple($total, array $customValues = array())
    {
        for ($i = 1; $i <= $total; ++$i) {
            $this->create($customValues);
        }
    }

    abstract public function getModel();
    abstract public function getDummyData(Generator $faker, array $customValues = array());

    protected function create(array $customValues = array())
    {
        $values = $this->getDummyData(Faker::create(), $customValues);
        $values = array_merge($values, $customValues);

        return $this->addToPool($this->getModel()->create($values));
    }

    protected function createFrom($seeder, array $customValues = array())
    {
        $seeder = new $seeder();

        return $seeder->create($customValues);
    }

    protected function getRandom($model)
    {
        if (!$this->collectionExists($model)) {
            throw new Exception("the $model collection does not exist");
        }

        return static::$pool[$model]->random();
    }

    /**
     * @param $entity
     *
     * @return mixed
     */
    private function addToPool($entity)
    {

        //$class = get_class($entity);
        //dd($class);
        $reflection = new ReflectionClass($entity);
        $class = $reflection->getShortName();

        if (!$this->collectionExists($class)) {
            static::$pool[$class] = new Collection();
        }
        static::$pool[$class]->add($entity);

        return $entity;
    }

    /**
     * @param $class
     *
     * @return bool
     */
    private function collectionExists($class)
    {
        return isset(static::$pool[$class]);
    }
}
