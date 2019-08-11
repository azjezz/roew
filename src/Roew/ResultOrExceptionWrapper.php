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
 * Represents a result of operation that either has a successful result or the exception object if that operation failed.
 *
 * This is an abstract class. You get generally `ResultOrExceptionWrapper<T>` by calling `wrap<T>()`, passing in the `callable(): T`,
 * and a `WrappedResult<T>` or `WrappedException<Te, Tr>` is returned.
 *
 * @template T
 */
abstract class ResultOrExceptionWrapper
{
    /**
     * Return the result of the operation, or throw underlying exception.
     *
     * - if the operation succeeded: return its result.
     * - if the operation failed: throw the exception inciting failure.
     *
     * @pslan-return T - The result of the operation upon success
     *
     * @return mixed - The result of the operation upon success
     */
    abstract public function getResult();

    /**
     * Return the underlying exception, or fail with a logic exception.
     *
     * - if the operation succeeded: fails with a logic exception.
     * - if the operation failed: returns the exception indicating failure.
     *
     * @throws \LogicException - When the operation succeeded
     */
    abstract public function getException(): \Exception;

    /**
     * Indicates whether the operation associated with this wrapper existed normally.
     *
     * if `isSucceeded()` returns `true`, `isFailed()` returns false.
     *
     * @return bool - `true` if the operation succeeded; `false` otherwise
     */
    abstract public function isSucceeded(): bool;

    /**
     * Indicates whether the operation associated with this wrapper exited abnormally via an exception of some sort.
     *
     * if `isFailed()` returns `true`, `isSucceeded()` returns false.
     *
     * @return bool - `true` if the operation failed; `false` otherwise
     */
    abstract public function isFailed(): bool;
}
