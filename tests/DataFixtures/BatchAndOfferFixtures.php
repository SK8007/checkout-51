<?php


namespace App\Tests\DataFixtures;

use App\Entity\Batch;
use App\Entity\Offer;
use Doctrine\ORM\EntityManager;
use DateTime;

class BatchAndOfferFixtures
{
    /** @var Batch|null $batch */
    public $batch;

    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function __destruct()
    {
        $this->em->getConnection()->close();
    }

    public function setUp() : void
    {
        $this->resetDb();

        $data = json_decode(file_get_contents(__DIR__ . "/../../c51.json"), true);

        $this->batch = $batch = new Batch();
        $batch->setBatchId($data['batch_id']);
        $batch->setStartDate(new DateTime());

        $this->em->persist($batch);

        foreach ($data['offers'] as $offer) {
            $offerEntity = new Offer();
            $offerEntity->setOfferId($offer['offer_id']);
            $offerEntity->setName($offer['name']);
            $offerEntity->setImageUrl($offer['image_url']);
            $offerEntity->setCashBack($offer['cash_back']);
            $offerEntity->setBatch($batch);

            $this->em->persist($offerEntity);
        }

        $this->em->flush();
    }

    public function tearDown() : void
    {
        $this->resetDb();
        $this->em->getConnection()->close();
    }

    private function resetDb() : void
    {
        $this->em->getConnection()->executeQuery('DELETE FROM offer');
        $this->em->getConnection()->executeQuery('DELETE FROM batch');
    }
}
