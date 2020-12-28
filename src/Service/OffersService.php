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
     * @return BatchModel
     */
    public function getCurrentBatchOfOffers()
    {
        $currentBatch = $this->batchRepository->findCurrentBatch();
        $currentBatchModel = new BatchModel($currentBatch);
        return $currentBatchModel;
    }
}
