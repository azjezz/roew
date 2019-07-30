<?php

declare(strict_types=1);

namespace Roew\Test;


use Roew\WrappedException;
use PHPUnit\Framework\TestCase;

class WrappedExceptionTest extends TestCase {
    public function testIsSucceeded(): void {
        $wrapper = new WrappedException(new \Exception('foo'));
        $this->assertFalse($wrapper->isSucceeded());
    }

    public function testIsFailed(): void {
        $wrapper = new WrappedException(new \Exception('foo'));
        $this->assertTrue($wrapper->isFailed());
    }

    public function testGetResult(): void {
        $exception = new \Exception('bar');
        $wrapper = new WrappedException($exception);
        try {
            $wrapper->getResult();
            $this->fail('WrappedException::getResult() should throw the underlying exception.');
        } catch(\Throwable $e) {
            $this->assertSame($exception, $e);
        }
    }

    public function testGetException(): void {
        $exception = new \Exception('bar');
        $wrapper = new WrappedException($exception);
        $e = $wrapper->getException();
        $this->assertSame($exception, $e);
    }
}
