<?php


namespace App\Model;

use App\Entity\Offer;

class OfferModel
{
    /** @var int $offerId */
    public $offerId;

    /** @var string $name */
    public $name;

    /** @var string $imageUrl */
    public $imageUrl;

    /** @var float $cashBack */
    public $cashBack;

    /**
     * OfferModel constructor.
     * @param Offer|null $offer
     */
    public function __construct(?Offer $offer = null)
    {
        if (is_null($offer)) {
            return;
        }
        $this->offerId = $offer->getOfferId();
        $this->name = $offer->getName();
        $this->imageUrl = $offer->getImageUrl();
        $this->cashBack = $offer->getCashBack();
    }
}