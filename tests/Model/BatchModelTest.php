<?php

namespace App\Tests\Model;

use App\Entity\Batch;
use App\Entity\Offer;
use App\Model\BatchModel;
use App\Model\OfferModel;
use PHPUnit\Framework\TestCase;

class BatchModelTest extends TestCase
{
    /**
     * @test
     */
    public function testConstructorPopulatesPropertiesGivenBatchEntity()
    {
        $offer = new Offer();
        $offer->setOfferId(40408);
        $offer->setName("Buy 2: Select TRISCUIT Crackers");
        $offer->setImageUrl("https://d3bx4ud3idzsqf.cloudfront.net/public/production/6840/67561_1535141624.jpg");
        $offer->setCashBack(1.0);

        $batch = new Batch();
        $batch->setBatchId(0);
        $batch->addOffer($offer);

        $expectedOfferModel = new OfferModel();
        $expectedOfferModel->offerId = $offer->getOfferId();
        $expectedOfferModel->name = $offer->getName();
        $expectedOfferModel->imageUrl = $offer->getImageUrl();
        $expectedOfferModel->cashBack = $offer->getCashBack();

        $batchModel = new BatchModel($batch);

        $this->assertEquals($batch->getBatchId(), $batchModel->batchId);
        $this->assertEquals([$expectedOfferModel], $batchModel->offers);
    }

    /**
     * @test
     */
    public function testConstructorReturnsEmptyObjectGivenNoArguments()
    {
        $batchModel = new BatchModel();

        $this->assertNull($batchModel->batchId);
        $this->assertEquals([], $batchModel->offers);

    }
}
