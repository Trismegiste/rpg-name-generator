<?php

/*
 * Name Generator
 */

namespace Trismegiste\NameGenerator;

/**
 * A service for name generating
 */
interface Repository
{

    /**
     * Gets the list of available languages for surnames
     * @return array
     */
    public function getSurnameLanguage(): array;

    /**
     * Gets the list of available languages for given names
     * Note : Those languages could be slightly different from surnames
     * @return array
     */
    public function getGivenNameLanguage(): array;

    /**
     * Gets the listing of given names for a given gender and a given language ()
     * @param string $gender a string 'male' or 'female'
     * @param string $lang One item of the list returned by getGivenNameLanguage
     * @return array
     */
    public function getGivenNameListFor(string $gender, string $lang): array;

    /**
     * Gets the listing of surnames for a given language
     * @param string $lang One item of the list returned by getSurnameLanguage
     * @return array
     */
    public function getSurnameListFor(string $lang): array;
}
