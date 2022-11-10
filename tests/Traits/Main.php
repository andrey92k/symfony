<?php

namespace App\Tests\Traits;

trait Main
{
    /**
     * Load fixtures for tests
     *
     * @param array $array
     * @return object App/Tests/Fixture
     */
    public function loadFixtures(array $array): object
    {
        return $this->databaseTool->loadFixtures($array);
    }

    /**
     * Get data from fixture use reference
     *
     * @param object $executor
     * @param string $reference
     * @return object App/Tests/Fixture
     */
    public function getReference(object $executor, string $reference): object
    {
        return $executor->getReferenceRepository()->getReference($reference);
    }
}