URI
=======

The `shampeak/request` package provides simple and intuitive classes to create and manage URIs in PHP.

Highlights
------

- Simple API
- [RFC3986](http://tools.ietf.org/html/rfc3986) compliant
- Implements the `UriInterface` from [PSR-7][]
- Fully documented
- Framework Agnostic
- Composer ready, [PSR-2][] and [PSR-4][] compliant

Documentation
------

Full documentation can be found at [url.thephpleague.com](http://url.thephpleague.com). Contribute to this documentation in the [gh-pages](https://github.com/thephpleague/url/tree/gh-pages) branch

System Requirements
-------

You need:

- **PHP >= 5.5.0** , but the latest stable version of PHP is recommended
- the `mbstring` extension
- "league/url": "^3.3"

To use the library.

Install
-------

Install `shampeak\request` using Composer.

```
$ composer require shampeak/request
```

Testing
-------

`League\Uri` has a [PHPUnit](https://phpunit.de) test suite and a coding style compliance test suite using [PHP CS Fixer](http://cs.sensiolabs.org/). To run the tests, run the following command from the project folder.

``` bash
$ composer test
```

Use
-------

```
//$req = new Sham\Http\Request(Sham\Environment::getInstance());
$req = new Sham\Request() ;
$get = $req->get();       //GET数据
$path1 = $req->getPath(); //path数据
$path2 = $req->getPath()->toArray();  //path数组
```


Contributing
-------

Contributions are welcome and will be fully credited. Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

Security
-------

If you discover any security related issues, please email shampeak@sina.com instead of using the issue tracker.

License
-------

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[PSR-2]: http://www.php-fig.org/psr/psr-2/
[PSR-4]: http://www.php-fig.org/psr/psr-4/
[PSR-7]: http://www.php-fig.org/psr/psr-7/
