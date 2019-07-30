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
 * Represents the result of successful operation.
 *
 * @template T
 *
 * @extends ResultOrExceptionWrapper<T>
 */
final class WrappedResult extends ResultOrExceptionWrapper
{
    /**
     * @psalm-var T
     *
     * @var mixed
     */
    private $value;

    /**
     * @psalm-param T $value
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Since this is a successful result wrapper, this always returns the actual result of the operation.
     *
     * @psalm-return T
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->value;
    }

    /**
     * Since this is a successful result wrapper, this always throws a
     * `LogicException` saying that there was no exception thrown from the operation.
     *
     * @throws \LogicException
     */
    public function getException(): \Exception
    {
        throw new \LogicException('No exception thrown from the operation.');
    }

    /**
     * Since this is a successful result wrapper, this always returns `true`.
     *
     * @return true
     */
    public function isSucceeded(): bool
    {
        return true;
    }

    /**
     * Since this is a successful result wrapper, this always returns `false`.
     *
     * @return false
     */
    public function isFailed(): bool
    {
        return false;
    }
}
