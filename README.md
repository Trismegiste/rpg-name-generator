# RPG-Name-Generator
The RPG character name generator library is designed to create list of random names used for table-top role-playing games.

This library was extracted from the website [PHP-Character-Name-Generator](https://github.com/mark-tasaka/PHP-Character-Name-Generator) 
from [Mark Tasaka](https://github.com/mark-tasaka) after a heavy overhaul and with the help of 
[nikic/PHP-Parser](https://github.com/nikic/PHP-Parser) 
(by the way, this tool is awesome)

This library is fully tested with PhpUnit, 100% code coverage.

# Install
With Composer :
```bash
composer require trismegiste/rpg-name-generator
```

# Usage
See phpunit tests for how to use this library :
```php
    $repo = new FileRepository();
    print_r($repo->getSurnameListFor('japanese'));
    print_r($repo->getGivenNameListFor('female', 'japanese'));
```

RandomizerDecorator class is a decorator for adding randomizing capabilities :

```php
    $repo = new RandomizerDecorator(new FileRepository());
    print_r($repo->getSurnameListFor('random'));  // gets the list of surnames from a random language
    echo $repo->getRandomGivenNameFor('female', 'chinese');  // picks one random chinese female given name
    echo $repo->getRandomSurnameFor('french');  // picks one random french surname
    echo $repo->getRandomSurnameFor('random');  // picks one random surname from a random language (full random)
```

# Test
With PhpUnit :
```bash
vendor/bin/phpunit
```

# Code coverage
With phpdbg :
```bash
phpdbg -qrr vendor/bin/phpunit
firefox doc/coverage/index.html
``` 

