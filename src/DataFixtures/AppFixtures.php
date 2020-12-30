<?php

namespace App\DataFixtures;

use App\Entity\Batch;
use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = json_decode(file_get_contents(__DIR__ . "/../../c51.json"), true);

        $batch = new Batch();
        $batch->setBatchId($data['batch_id']);
        $batch->setStartDate(new DateTime());

        $manager->persist($batch);

        foreach ($data['offers'] as $offer) {
            $offerEntity = new Offer();
            $offerEntity->setOfferId($offer['offer_id']);
            $offerEntity->setName($offer['name']);
            $offerEntity->setImageUrl($offer['image_url']);
            $offerEntity->setCashBack($offer['cash_back']);
            $offerEntity->setBatch($batch);

            $manager->persist($offerEntity);
        }

        $manager->flush();
    }
}
