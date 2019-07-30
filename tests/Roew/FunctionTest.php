<?php

declare(strict_types=1);

namespace Roew\Test;

use Roew as w;
use PHPUnit\Framework\TestCase;

class FunctionTest extends TestCase {
    public function testResult(): void {
        $wrapper = w\result('foo');
        $this->assertTrue($wrapper->isSucceeded());
        $this->assertFalse($wrapper->isFailed());
        $this->assertSame('foo', $wrapper->getResult());
        try {
            $wrapper->getException();
            $this->fail('Expected WrappedResult::getException() to throw a logic exception.');
        } catch(\Throwable $e) {
            $this->assertInstanceOf(\LogicException::class, $e);
            $this->assertStringContainsString('No exception thrown', $e->getMessage());
        }
    }

    public function testException(): void {
        $exception = new \Exception('foo');
        $wrapper = w\exception($exception);
        $this->assertFalse($wrapper->isSucceeded());
        $this->assertTrue($wrapper->isFailed());
        $this->assertSame($exception, $wrapper->getException());
        try {
            $wrapper->getResult();
            $this->fail('WrappedException::getResult() should throw the underlying exception.');
        } catch(\Throwable $e) {
            $this->assertSame($exception, $e);
        }
    }

    public function testWrap(): void {
        $exception = new \Exception('foo');
        $wrapper = w\wrap(static function() use($exception): void {
            throw $exception;
        });
        $this->assertFalse($wrapper->isSucceeded());
        $this->assertTrue($wrapper->isFailed());
        $this->assertSame($exception, $wrapper->getException());
        try {
            $wrapper->getResult();
            $this->fail('WrappedException::getResult() should throw the underlying exception.');
        } catch(\Throwable $e) {
            $this->assertSame($exception, $e);
        }

        $wrapper = w\wrap(static function (): string {
            return 'foo';
        });
        $this->assertTrue($wrapper->isSucceeded());
        $this->assertFalse($wrapper->isFailed());
        $this->assertSame('foo', $wrapper->getResult());
        try {
            $wrapper->getException();
            $this->fail('Expected WrappedResult::getException() to throw a logic exception.');
        } catch(\Throwable $e) {
            $this->assertInstanceOf(\LogicException::class, $e);
            $this->assertStringContainsString('No exception thrown', $e->getMessage());
        }

    }
}