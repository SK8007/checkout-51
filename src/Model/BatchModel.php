<?php


namespace App\Model;

use App\Entity\Batch;
use App\Entity\Offer;

class BatchModel
{
    /** @var int $batchId */
    public $batchId;

    /** @var OfferModel[] $offers */
    public $offers = [];

    /**
     * BatchModel constructor.
     * @param Batch|null $batch
     */
    public function __construct(?Batch $batch = null)
    {
        if (is_null($batch)) {
            return;
        }
        $this->batchId = $batch->getBatchId();
        foreach ($batch->getOffers()->toArray() as $offer) {
            $this->offers []= new OfferModel($offer);
        }
    }
}