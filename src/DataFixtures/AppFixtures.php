<?php

namespace App\DataFixtures;

use App\Entity\Batch;
use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateInterval;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $fileContents = file_get_contents(__DIR__ . "/c51.json");
        $contents = json_decode($fileContents, true);

        var_dump($contents);

        $batch = new Batch();
        $batch->setBatchId($contents['batch_id']);
        $now = new DateTime();
        $oneWeek = new DateInterval('P1W');
        $oneWeekFromNow = $now->add($oneWeek);
        $batch->setStartDate($now);
        $batch->setEndDate($oneWeekFromNow);

        $manager->persist($batch);

        foreach ($contents['offers'] as $offer) {
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
