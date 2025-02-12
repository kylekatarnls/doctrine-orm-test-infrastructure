<?php

namespace Webfactory\Doctrine\Config;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use PHPUnit\Framework\TestCase;
use Webfactory\Doctrine\ORMTestInfrastructure\ORMInfrastructure;
use Webfactory\Doctrine\ORMTestInfrastructure\ORMInfrastructureTest\TestEntity;

class ExistingConnectionConfigurationTest extends TestCase
{
    /**
     * @var ExistingConnectionConfiguration
     */
    private $connectionConfiguration = null;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * Initializes the test environment.
     */
    protected function setUp(): void
    {
        $this->connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'memory' => true,
        ]);

        $this->connectionConfiguration = new ExistingConnectionConfiguration($this->connection);

        parent::setUp();
    }

    public function testWorksWithInfrastructure()
    {
        $infrastructure = ORMInfrastructure::createOnlyFor(
            ['Webfactory\Doctrine\ORMTestInfrastructure\ORMInfrastructureTest\TestEntity'],
            $this->connectionConfiguration
        );

        $infrastructure->import(new TestEntity());

        $this->assertEquals(1, $this->connection->fetchOne('SELECT COUNT(*) FROM test_entity'));
    }

}
