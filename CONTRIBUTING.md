# Contributing

Contributions through Pull Requests are welcome and will be **credited**

## Pull Requests

- Follow **[PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** coding standard
- **Unit test everything**!
- Try not to bring **code coverage** down
- Keep documentation **updated**
- Just **one pull request per feature** at a time
- Check that **[Travis CI](https://travis-ci.org/juliangut/slim-controller)** build passed

## Code Quality

Grunt tasks are provided to help you keep code quality

- `grunt` will run PHP linting, [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer) for style guidelines, [PHPMD](https://github.com/phpmd/phpmd) for code smells and [PHPCPD](https://github.com/sebastianbergmann/phpcpd) for copy/paste detection
- `grunt phpunit` will run [PHPUnit](https://github.com/sebastianbergmann/phpunit) for unit tests
- `grunt all` will run all previous commands at once
