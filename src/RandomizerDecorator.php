<?php

/*
 * Name Generator
 */

namespace Trismegiste\NameGenerator;

/**
 * Service for randomizing the name generator repository
 * Design Pattern : Decorator
 */
class RandomizerDecorator implements Repository
{

    protected $decorated;

    public function __construct(Repository $repo)
    {
        $this->decorated = $repo;
    }

    public function getGivenNameLanguage(): array
    {
        return $this->decorated->getGivenNameLanguage();
    }

    public function getGivenNameListFor(string $gender, string $lang): array
    {
        if ($lang === 'random') {
            $listing = $this->getGivenNameLanguage();
            $lang = $listing[random_int(0, count($listing) - 1)];
        }

        return $this->decorated->getGivenNameListFor($gender, $lang);
    }

    public function getSurnameLanguage(): array
    {
        return $this->decorated->getSurnameLanguage();
    }

    public function getSurnameListFor(string $lang): array
    {
        if ($lang === 'random') {
            $listing = $this->getSurnameLanguage();
            $lang = $listing[random_int(0, count($listing) - 1)];
        }

        return $this->decorated->getSurnameListFor($lang);
    }

    public function getRandomGivenNameFor(string $gender, string $lang): string
    {
        $listing = $this->getGivenNameListFor($gender, $lang);

        return $listing[random_int(0, count($listing) - 1)];
    }

    public function getRandomSurnameFor(string $lang): string
    {
        $listing = $this->getSurnameListFor($lang);

        return $listing[random_int(0, count($listing) - 1)];
    }

}
