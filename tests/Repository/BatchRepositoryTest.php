<?php

namespace App\Tests\Repository;

use App\Entity\Batch;
use App\Repository\BatchRepository;
use App\Tests\DataFixtures\BatchAndOfferFixtures;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BatchRepositoryTest extends KernelTestCase
{
    /** @var EntityManager $entityManager */
    private $entityManager;

    /** @var BatchAndOfferFixtures $batchAndOfferFixtures */
    private $batchAndOfferFixtures;

    /** @var BatchRepository $batchRepository */
    private $batchRepository;

    public function setUp() : void
    {
        parent::setUp();

        self::bootKernel();
        $container = static::$kernel->getContainer();

        $this->entityManager = $container->get('doctrine.orm.entity_manager');
        $this->batchAndOfferFixtures = new BatchAndOfferFixtures($this->entityManager);
        $this->batchAndOfferFixtures->setUp();

        $this->batchRepository = $this->entityManager->getRepository(Batch::class);
    }

    public function tearDown() : void
    {
        $this->batchAndOfferFixtures->tearDown();
        $this->entityManager->getConnection()->close();

        parent::tearDown();
    }

    /**
     * @test
     */
    public function testGetCurrentBatches()
    {
        $currentBatches = $this->batchRepository->getCurrentBatches();

        $this->assertEquals(
            [$this->batchAndOfferFixtures->batch],
            $currentBatches
        );
    }
}
