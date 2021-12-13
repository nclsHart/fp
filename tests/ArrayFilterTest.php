<?php

declare(strict_types=1);

namespace Crell\fp;

use PHPUnit\Framework\TestCase;

class ArrayFilterTest extends TestCase
{
    /**
     * @test
     */
    public function itfilter(): void
    {
        $result = itfilter(fn(int $x): bool => !($x % 2))([5, 6, 7, 8]);
        self::assertEquals([1 => 6, 3 => 8], iterator_to_array($result));
    }

    /**
     * @test
     */
    public function itfilter_default_callback(): void
    {
        $result = itfilter()([5, 0, '', 8]);
        self::assertEquals([0 => 5, 3 => 8], iterator_to_array($result));
    }

    /**
     * @test
     */
    public function afilter(): void
    {
        $result = afilter(fn(int $x): bool => !($x % 2))([5, 6, 7, 8]);
        self::assertEquals([1 => 6, 3 => 8], $result);
    }

    /**
     * @test
     */
    public function afilter_iterator(): void
    {
        $gen = function () {
            yield from [5, 6, 7, 8];
        };
        $result = afilter(fn(int $x): bool => !($x % 2))($gen());
        self::assertEquals([1 => 6, 3 => 8], $result);
    }

    /**
     * @test
     */
    public function afilter_default_callback(): void
    {
        $result = afilter()([5, 0, '', 8]);
        self::assertEquals([0 => 5, 3 => 8], $result);
    }
}
