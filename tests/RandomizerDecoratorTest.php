<?php

/*
 * Name Generator
 */

use PHPUnit\Framework\TestCase;
use Trismegiste\NameGenerator\FileRepository;
use Trismegiste\NameGenerator\RandomizerDecorator;

class RandomizerDecoratorTest extends TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $this->sut = new RandomizerDecorator(new FileRepository(__DIR__ . '/database'));
    }

    public function testRandomSurname()
    {
        $name = $this->sut->getRandomSurnameFor('starwars');
        $this->assertContains($name, ['Organa', 'Solo', 'Skywalker']);
    }

    public function testRandomGivenName()
    {
        $name = $this->sut->getRandomGivenNameFor('female', 'trilogy');
        $this->assertNotEmpty($name);
    }

}
