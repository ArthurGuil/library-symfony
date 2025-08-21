<?php

namespace App\Tests\Entity;

use App\Entity\Book;
use App\Entity\Reservation;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testGetSetId()
    {
        $book = new Book();
        $this->assertNull($book->getId(), 'ID should be null on new entity');
    }

    public function testGetSetName()
    {
        $book = new Book();
        $book->setName('Test Book');
        $this->assertSame('Test Book', $book->getName());
    }

    public function testGetSetSummary()
    {
        $book = new Book();
        $summary = 'This is a test summary of the book.';
        $book->setSummary($summary);
        $this->assertSame($summary, $book->getSummary());
    }

    public function testGetSetStock()
    {
        $book = new Book();
        $book->setStock(42);
        $this->assertSame(42, $book->getStock());
    }

    public function testGetSetCover()
    {
        $book = new Book();
        $cover = 'cover.jpg';
        $book->setCover($cover);
        $this->assertSame($cover, $book->getCover());
    }

    public function testGetSetAuthor()
    {
        $book = new Book();
        $author = 'Jane Doe';
        $book->setAuthor($author);
        $this->assertSame($author, $book->getAuthor());
    }

    public function testAddRemoveReservation()
    {
        $book = new Book();
        $reservation = new Reservation();

        $this->assertCount(0, $book->getReservations());

        $book->addReservation($reservation);
        $this->assertCount(1, $book->getReservations());
        $this->assertTrue($book->getReservations()->contains($reservation));

        $book->removeReservation($reservation);
        $this->assertCount(0, $book->getReservations());
    }
}
