<?php

/*
 * Name Generator
 */

namespace Trismegiste\NameGenerator;

/**
 * Implementation of Repository with YAML file
 */
class FileRepository implements Repository
{

    protected $folder;
    private $givenNameLanguage = null;
    private $surnameLanguage = null;
    private $cacheSurname = [];
    private $cacheGivenName = ['female' => [], 'male' => []];

    public function __construct(string $dbFolder)
    {
        $this->folder = $dbFolder;
    }

    public function getSurnameLanguage(): array
    {
        if (is_null($this->surnameLanguage)) {
            $finder = new \Symfony\Component\Finder\Finder();
            $surname = $finder->files()->in($this->folder . '/surname')->name('*.yml');

            $this->surnameLanguage = [];
            foreach ($surname as $fileInfo) {
                $this->surnameLanguage[] = $fileInfo->getBasename('.yml');
            }
        }

        return $this->surnameLanguage;
    }

    public function getGivenNameLanguage(): array
    {
        if (is_null($this->givenNameLanguage)) {
            $finder = new \Symfony\Component\Finder\Finder();
            $given = $finder->files()->in($this->folder . '/female')->name('*.yml');

            $this->givenNameLanguage = [];
            foreach ($given as $fileInfo) {
                $this->givenNameLanguage[] = $fileInfo->getBasename('.yml');
            }
        }

        return $this->givenNameLanguage;
    }

    public function getGivenNameListFor(string $gender, string $lang): array
    {
        if (!in_array($gender, array_keys($this->cacheGivenName))) {
            throw new \OutOfBoundsException("$gender is not a valid gender");
        }

        if (!array_key_exists($lang, $this->cacheGivenName[$gender])) {
            $langListing = $this->getGivenNameLanguage();
            // this seems a little overkill but it prevents some clowns to inject some infamous path into the form
            if (false === array_search($lang, $langListing)) {
                throw new \OutOfBoundsException("$lang is not a valid language for a given name");
            }
            $this->cacheGivenName[$gender][$lang] = \Symfony\Component\Yaml\Yaml::parseFile("{$this->folder}/$gender/$lang.yml");
        }

        return $this->cacheGivenName[$gender][$lang];
    }

    public function getSurnameListFor(string $lang): array
    {
        if (!array_key_exists($lang, $this->cacheSurname)) {
            $langListing = $this->getSurnameLanguage();
            // this seems a little overkill but it prevents some clowns to inject some infamous path into the form
            if (false === array_search($lang, $langListing)) {
                throw new \OutOfBoundsException("$lang is not a valid language for Surname");
            }
            $this->cacheSurname[$lang] = \Symfony\Component\Yaml\Yaml::parseFile("{$this->folder}/surname/$lang.yml");
        }

        return $this->cacheSurname[$lang];
    }

}
