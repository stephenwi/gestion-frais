<?php

namespace App\Test\Controller;

use App\Entity\NoteFrais;
use App\Repository\NoteFraisRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NoteFraisControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private NoteFraisRepository $repository;
    private string $path = '/note/frais/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(NoteFrais::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('NoteFrai index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'note_frai[identifiant]' => 'Testing',
            'note_frai[note_date]' => 'Testing',
            'note_frai[amount]' => 'Testing',
            'note_frai[registeredAt]' => 'Testing',
            'note_frai[note_type]' => 'Testing',
            'note_frai[company]' => 'Testing',
        ]);

        self::assertResponseRedirects('/note/frais/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new NoteFrais();
        $fixture->setIdentifiant('My Title');
        $fixture->setNote_date('My Title');
        $fixture->setAmount('My Title');
        $fixture->setRegisteredAt('My Title');
        $fixture->setNote_type('My Title');
        $fixture->setCompany('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('NoteFrai');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new NoteFrais();
        $fixture->setIdentifiant('My Title');
        $fixture->setNote_date('My Title');
        $fixture->setAmount('My Title');
        $fixture->setRegisteredAt('My Title');
        $fixture->setNote_type('My Title');
        $fixture->setCompany('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'note_frai[identifiant]' => 'Something New',
            'note_frai[note_date]' => 'Something New',
            'note_frai[amount]' => 'Something New',
            'note_frai[registeredAt]' => 'Something New',
            'note_frai[note_type]' => 'Something New',
            'note_frai[company]' => 'Something New',
        ]);

        self::assertResponseRedirects('/note/frais/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getIdentifiant());
        self::assertSame('Something New', $fixture[0]->getNote_date());
        self::assertSame('Something New', $fixture[0]->getAmount());
        self::assertSame('Something New', $fixture[0]->getRegisteredAt());
        self::assertSame('Something New', $fixture[0]->getNote_type());
        self::assertSame('Something New', $fixture[0]->getCompany());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new NoteFrais();
        $fixture->setIdentifiant('My Title');
        $fixture->setNote_date('My Title');
        $fixture->setAmount('My Title');
        $fixture->setRegisteredAt('My Title');
        $fixture->setNote_type('My Title');
        $fixture->setCompany('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/note/frais/');
    }
}
