<?php

namespace App\Tests\Model;

use PHPUnit\Framework\TestCase;

use App\Entity\Offer;
use App\Model\OfferModel;

class OfferModelTest extends TestCase
{
    /**
     * @test
     */
    public function testConstructorPopulatesPropertiesGivenOfferEntity()
    {
        $offer = new Offer();
        $offer->setOfferId(40408);
        $offer->setName("Buy 2: Select TRISCUIT Crackers");
        $offer->setImageUrl("https://d3bx4ud3idzsqf.cloudfront.net/public/production/6840/67561_1535141624.jpg");
        $offer->setCashBack(1.0);

        $offerModel = new OfferModel($offer);

        $this->assertEquals($offer->getOfferId(), $offerModel->offerId);
        $this->assertEquals($offer->getName(), $offerModel->name);
        $this->assertEquals($offer->getImageUrl(), $offerModel->imageUrl);
        $this->assertEquals($offer->getCashBack(), $offerModel->cashBack);
    }

    /**
     * @test
     */
    public function testConstructorReturnsEmptyObjectGivenNoArguments()
    {
        $offerModel = new OfferModel();

        $this->assertNull($offerModel->offerId);
        $this->assertNull($offerModel->name);
        $this->assertNull($offerModel->imageUrl);
        $this->assertNull($offerModel->cashBack);
    }
}
