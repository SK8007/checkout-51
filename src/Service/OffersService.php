<?php


namespace App\Service;

use App\Model\BatchModel;
use App\Repository\BatchRepository;

class OffersService
{
    private $batchRepository;

    /**
     * OffersService constructor.
     */
    public function __construct(BatchRepository $batchRepository)
    {
        $this->batchRepository = $batchRepository;
    }

    /**
     * @return BatchModel|null
     */
    public function getCurrentBatchOfOffers() : ?BatchModel
    {
        $currentBatches = $this->batchRepository->getCurrentBatches();

        return empty($currentBatches) ? null : new BatchModel(reset($currentBatches));
    }
}
