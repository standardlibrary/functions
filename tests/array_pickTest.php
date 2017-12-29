<?php
declare(strict_types=1);
/**
 * This file is part of the Standard Libray functions package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

use PHPUnit\Framework\TestCase;

final class array_pick_test extends TestCase
{
    /**
     * Test that array_pick yields items from subject array
     *
     * @dataProvider iterator
     * @param mixed $needle
     * @param array $haystack
     * @return void
     */
    final public function testYieldFromArrayPick($needle, array $haystack): void
    {
        $this->assertContains($needle, $haystack);
    }

    final public function iterator(): Iterator
    {
        return [
            'Numeric array' => [
                array_pick([1, 2, 3, 4]),
                [1, 2, 3, 4]
            ],

            'String array' => [
                array_pick(['foo', 'bar', 'baz']),
                ['foo', 'bar', 'baz']
            ],

            'Mixed array' => [
                array_pick(['foo', 10, null]),
                ['foo', 10, null]
            ],
        ];
    }
}
