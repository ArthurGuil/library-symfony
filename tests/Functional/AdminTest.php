<?php

namespace App\Tests;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminTest extends WebTestCase
{
    public function testAdminAccessToBookManagement(): void
    {
        $client = static::createClient();
        $client->request('GET', '/book/new');

        $this->assertResponseRedirects('/login'); // Redirigé si non authentifié
    }

    public function testBookListIsDisplayed()
    {
        $client = static::createClient();

        // Récupération de l'EntityManager pour insérer un livre de test
        /** @var EntityManagerInterface $em */
        $em = static::getContainer()->get(EntityManagerInterface::class);

        // Création d'un livre de test
        $book = new Book();
        $book->setName('Le Petit Prince');
        $book->setAuthor('Antoine de Saint-Exupéry');
        $em->persist($book);
        $em->flush();

        // Accès à la page /book
        $crawler = $client->request('GET', '/book');

        // Vérifie que la page répond bien
        $this->assertResponseIsSuccessful();

        // Vérifie que le livre est affiché dans la page
        $this->assertSelectorTextContains('body', 'Le Petit Prince');
        $this->assertSelectorTextContains('body', 'Antoine de Saint-Exupéry');
    }
}
