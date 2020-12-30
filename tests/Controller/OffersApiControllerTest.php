<?php

namespace App\Tests\Controller;

use App\Tests\DataFixtures\BatchAndOfferFixtures;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class OffersApiControllerTest extends WebTestCase
{
    /** @var KernelBrowser $client */
    private $client;

    /** @var EntityManager $entityManager */
    private $entityManager;

    /** @var BatchAndOfferFixtures $batchAndOfferFixtures */
    private $batchAndOfferFixtures;

    public function setUp() : void
    {
        parent::setUp();

        $this->client = static::createClient();

        self::bootKernel();
        $container = static::$kernel->getContainer();

        $this->entityManager = $container->get('doctrine.orm.entity_manager');
        $this->batchAndOfferFixtures = new BatchAndOfferFixtures($this->entityManager);
        $this->batchAndOfferFixtures->setUp();
    }

    public function tearDown() : void
    {
        $this->batchAndOfferFixtures->tearDown();
        $this->entityManager->getConnection()->close();

        parent::tearDown();
    }

    /**
     * @test
     */
    public function testGetOffers()
    {
        $this->client->request('GET', '/api/offers');
        $this->assertResponseIsSuccessful();

        $data = json_decode(file_get_contents(__DIR__ . "/../../c51.json"), true);
        $response = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertEquals($data['batch_id'], $response['batchId']);
        foreach ($response['offers'] as $i => $offer) {
            $this->assertEquals($data['offers'][$i]['offer_id'], $offer['offerId']);
            $this->assertEquals($data['offers'][$i]['name'], $offer['name']);
            $this->assertEquals($data['offers'][$i]['image_url'], $offer['imageUrl']);
            $this->assertEquals($data['offers'][$i]['cash_back'], $offer['cashBack']);
        }
    }
}
