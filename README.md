# Roew

Hack-like result or exception wrapper for PHP.

---

[![Build Status](https://travis-ci.org/azjezz/roew.svg?branch=master)](https://travis-ci.org/azjezz/roew)
[![SymfonyInsight](https://insight.symfony.com/projects/32f4eae2-04a5-4657-b172-86cdac6c104c/mini.svg)](https://insight.symfony.com/projects/32f4eae2-04a5-4657-b172-86cdac6c104c)
[![Total Downloads](https://poser.pugx.org/azjezz/roew/d/total.svg)](https://packagist.org/packages/azjezz/sweet)
[![Latest Stable Version](https://poser.pugx.org/azjezz/roew/v/stable.svg)](https://github.com/azjezz/roew/releases)
[![License](https://poser.pugx.org/azjezz/roew/license.svg)](https://github.com/azjezz/roew/blob/master/LICENSE)

---

## Installation

This package can be installed with Composer.
```console
$ composer require azjezz/roew
```

## Usage

```php
<?php

use Roew as w;

$wrapper = w\result(5);
assert($wrapper->isSucceeded());
$result = $wrapper->getResult();

$wrapper = w\exception(new Exception('failed'));
assert($wrapper->isFailed());
$e = $wrapper->getException();

$wrapper = w\wrap(
    fn() => bin2hex(random_bytes(32))
);

if ($wrapper->isSucceeded()) {
    echo 'Succeeded : '.$wrapper->getResult();
} else {
    echo 'Failed : '.$wrapper->getException()->getMessage();
}
```

## API

`abstract Roew\ResultOrExceptionWrapper<T>`
> Represents a result of operation that either has a successful result or the exception object if that operation failed.
>
> This is an abstract class. You get generally `ResultOrExceptionWrapper<T>` by calling `wrap<T>()`, passing in the `callable(): T`,
> and a `WrappedResult<T>` or `WrappedException<Te, Tr>` is returned.
>
> `@template T`


`public function Roew\ResultOrExceptionWrapper<T>::getResult(): T`
> Return the result of the operation, or throw underlying exception.
>
> - if the operation succeeded: return its result.
> - if the operation failed: throw the exception inciting failure.
>
> `@return T` - The result of the operation upon success


`public Roew\ResultOrExceptionWrapper::getException(): Exception`
> Return the underlying exception, or fail with a logic exception.
>
> - if the operation succeeded: fails with a logic exception.
> - if the operation failed: returns the exception indicating failure.
>
> `@throws \LogicException` - When the operation succeeded


`public Roew\ResultOrExceptionWrapper::isSucceeded(): bool`
> Indicates whether the operation associated with this wrapper existed normally.
>
> if `isSucceeded()` returns `true`, `isFailed()` returns false.
>
> `@return bool` - `true` if the operation succeeded; `false` otherwise


`public Roew\ResultOrExceptionWrapper::isFailed(): bool`
> Indicates whether the operation associated with this wrapper exited abnormally via an exception of some sort.
>
> if `isFailed()` returns `true`, `isSucceeded()` returns false.
>
> `@return bool` - `true` if the operation failed; `false` otherwise

---

## References
- https://docs.hhvm.com/hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/
- https://docs.hhvm.com/hack/reference/class/HH.Asio.WrappedResult/
- https://docs.hhvm.com/hack/reference/class/HH.Asio.WrappedException/

---

## License

The Roew Project is open-sourced software licensed under the MIT license.