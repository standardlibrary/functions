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
     * @param array $array
     * @return void
     */
    final public function testYieldFromArrayPick(array $array): void
    {
        foreach(array_pick($array, rand(1, count($array))) as $needle) {
            $this->assertContains($needle, $haystack);
        }
    }

    final public function iterator(): array
    {
        return [
            'Numeric array' => [
                range(0, 10000)
            ],

            'String array' => [
                range('a', 'z')
            ],

            'Mixed array' => [
                array_combine(range(0,24), range('a', 'z'))
            ],

            'Large array' => [
                rand(0, 10000000)
            ]
        ];
    }
}
