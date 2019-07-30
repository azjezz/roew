<?php

declare(strict_types=1);

/**
 * This file is part of the Roew package.
 *
 * (c) Saif Eddin Gmati <azjezz@protonmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Roew;

/**
 * @template     T
 *
 * @psalm-param  callable(): T $fun
 *
 * @psalm-return ResultOrExceptionWrapper<T>
 */
function wrap(callable $fun): ResultOrExceptionWrapper
{
    try {
        return result($fun());
    } catch (\Exception $e) {
        return exception($e);
    }
}

/**
 * @template     T
 *
 * @psalm-param  T $value
 *
 * @psalm-return WrappedResult<T>
 */
function result($value): WrappedResult
{
    return new WrappedResult($value);
}

/**
 * @template     Tr
 * @template     Te of \Exception
 *
 * @psalm-param  Te $e
 *
 * @psalm-return WrappedException<Te, Tr>
 */
function exception(\Exception $e): WrappedException
{
    return new WrappedException($e);
}
