<?php

/**
 *     This file is part of the Roew package.
 *
 *     (c) Saif Eddin Gmati <azjezz@protonmail.com>
 *
 *     For the full copyright and license information, please view the LICENSE
 *     file that was distributed with this source code.
 */

namespace Roew;

/**
 * Represents the result of failed operation.
 *
 * @template Tr
 * @template Te of \Exception
 *
 * @extends ResultOrExceptionWrapper<Tr>
 */
final class WrappedException extends ResultOrExceptionWrapper
{
    /**
     * @psalm-var Te
     *
     * @var \Exception
     */
    private $exception;

    /**
     * @psalm-param Te $exception
     *
     * @param \Exception $exception
     */
    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * Since this is a failed result wrapper, this always throws the exception thrown during the operation.
     *
     * @throws \Exception
     */
    public function getResult(): void
    {
        throw $this->exception;
    }

    /**
     * Since this is a failed result wrapper, this always returns the exception thrown during the operation.
     *
     * @psalm-return Te - The exception thrown during the operation.
     *
     * @return \Exception - The exception thrown during the operation
     */
    public function getException(): \Exception
    {
        return $this->exception;
    }

    /**
     * Since this is a failed result wrapper, this always returns `false`.
     *
     * @return false
     */
    public function isSucceeded(): bool
    {
        return false;
    }

    /**
     * Since this is a failed result wrapper, this always returns `true`.
     *
     * @return true
     */
    public function isFailed(): bool
    {
        return true;
    }
}
