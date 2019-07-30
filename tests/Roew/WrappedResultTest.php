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

namespace Roew\Test;

use PHPUnit\Framework\TestCase;
use Roew\WrappedResult;

class WrappedResultTest extends TestCase
{
    public function testIsSucceeded(): void
    {
        $wrapper = new WrappedResult('hello');
        $this->assertTrue($wrapper->isSucceeded());
    }

    public function testIsFailed(): void
    {
        $wrapper = new WrappedResult('hello');
        $this->assertFalse($wrapper->isFailed());
    }

    public function testGetResult(): void
    {
        $wrapper = new WrappedResult('hello');
        $this->assertSame('hello', $wrapper->getResult());
    }

    public function testGetException(): void
    {
        $wrapper = new WrappedResult('hello');
        try {
            $wrapper->getException();
            $this->fail('Expected WrappedResult::getException() to throw a logic exception.');
        } catch (\Throwable $e) {
            $this->assertInstanceOf(\LogicException::class, $e);
            $this->assertStringContainsString('No exception thrown', $e->getMessage());
        }
    }
}
