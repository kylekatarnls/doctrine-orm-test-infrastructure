<?php

namespace Webfactory\Doctrine\ORMTestInfrastructure\ORMInfrastructureTest\Inheritance;

use Doctrine\ORM\Mapping as ORM;
use Webfactory\Doctrine\ORMTestInfrastructure\ORMInfrastructureTest\ReferencedEntity;

/**
 * Mapped super class that references another entity.
 *
 * @ORM\MappedSuperclass()
 * @see http://doctrine-orm.readthedocs.org/en/latest/reference/inheritance-mapping.html#mapped-superclasses
 */
abstract class MappedSuperClassParentWithReference
{
    /**
     * Required reference to another entity.
     *
     * @var ReferencedEntity
     * @ORM\OneToOne(targetEntity="ReferencedEntity", cascade={"all"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $dependency = null;

    /**
     * Automatically creates a reference on construction.
     */
    public function __construct()
    {
        $this->dependency = new ReferencedEntity();
    }
}
