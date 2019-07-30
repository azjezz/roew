<?php

declare(strict_types=1);

namespace Roew\Test;


use Roew\WrappedResult;
use Roew\WrappedException;
use PHPUnit\Framework\TestCase;


class WrappedResultTest extends TestCase {
    public function testIsSucceeded(): void {
        $wrapper = new WrappedResult('hello');
        $this->assertTrue($wrapper->isSucceeded());
    }

    public function testIsFailed(): void {
        $wrapper = new WrappedResult('hello');
        $this->assertFalse($wrapper->isFailed());
    }

    public function testGetResult(): void {
        $wrapper = new WrappedResult('hello');
        $this->assertSame('hello', $wrapper->getResult());
    }

    public function testGetException(): void {
        $wrapper = new WrappedResult('hello');
        try {
            $wrapper->getException();
            $this->fail('Expected WrappedResult::getException() to throw a logic exception.');
        } catch(\Throwable $e) {
            $this->assertInstanceOf(\LogicException::class, $e);
            $this->assertStringContainsString('No exception thrown', $e->getMessage());
        }
    }
}
