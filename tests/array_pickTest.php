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
        $counter = 0;
        $limit = rand(1, count($array));

        foreach(array_pick($array, $limit) as $element) {
            $this->assertContains($element, $array);
            $this->assertLessThanOrEqual($limit, ++$counter);
        }
    }

    final public function iterator(): array
    {
        return [
            'Numeric array' => [
                range(0, 10)
            ],

            'String array' => [
                range('a', 'z')
            ],

            'Mixed array' => [
                array_merge(range(0,10), range('a', 'z'))
            ],

            'Associative array' => [
                array_combine(range('a', 'z'), range(1, 26))
            ],

            'Large array' => [
                rand(0, 1000000)
            ]
        ];
    }
}
