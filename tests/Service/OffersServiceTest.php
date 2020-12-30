<?php

namespace App\Tests\Service;

use App\Model\OfferModel;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

use App\Entity\Batch;
use App\Entity\Offer;
use App\Model\BatchModel;
use App\Repository\BatchRepository;
use App\Service\OffersService;

class OffersServiceTest extends TestCase
{
    /** @var MockObject $batchRepository */
    private $batchRepository;

    public function setUp()
    {
        parent::setUp();

        $this->batchRepository = $this->createMock(BatchRepository::class);
    }

    /**
     * @test
     */
    public function testGetCurrentBatchOfOffersReturnsNullWhenNoValidBatchesExist()
    {
        $this->batchRepository
            ->expects($this->once())
            ->method('getCurrentBatches')
            ->willReturn([]);

        $offersService = new OffersService($this->batchRepository);
        $result = $offersService->getCurrentBatchOfOffers();

        $this->assertNull($result);
    }

    /**
     * @test
     */
    public function testGetCurrentBatchOfOffersReturnsBatchModelForFirstValidBatch()
    {
        $offer = new Offer();
        $offer->setOfferId(40408);
        $offer->setName("Buy 2: Select TRISCUIT Crackers");
        $offer->setImageUrl("https://d3bx4ud3idzsqf.cloudfront.net/public/production/6840/67561_1535141624.jpg");
        $offer->setCashBack(1.0);

        $batch1 = new Batch();
        $batch1->setBatchId(0);
        $batch1->addOffer($offer);

        $batch2 = new Batch();

        $this->batchRepository
            ->expects($this->once())
            ->method('getCurrentBatches')
            ->willReturn([$batch1, $batch2]);

        $expectedOfferModel = new OfferModel();
        $expectedOfferModel->offerId = $offer->getOfferId();
        $expectedOfferModel->name = $offer->getName();
        $expectedOfferModel->imageUrl = $offer->getImageUrl();
        $expectedOfferModel->cashBack = $offer->getCashBack();

        $expectedBatchModel = new BatchModel();
        $expectedBatchModel->batchId = $batch1->getBatchId();
        $expectedBatchModel->offers = [$expectedOfferModel];

        $offersService = new OffersService($this->batchRepository);
        $result = $offersService->getCurrentBatchOfOffers();

        $this->assertEquals($expectedBatchModel, $result);
    }
}
