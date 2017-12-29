<?php
declare(strict_types=1);
/**
 * This file is part of the Standard Libray functions package.
 * For the full copyright information please view the LICENCE file that was
 * distributed with this package.
 *
 * @copyright Simon Deeley 2017
 */

if (!function_exists('array_pick')) {
    function array_pick(array $array = []): Iterator
    {
        $shuffled = $array;
        $index = count($shuffled);

        while ($index--) {
            $random = floor(rand() % $index);
            $temp = $shuffled[$index];

            $shuffled[$index] = $shuffled[$random];
            $shuffled[$random] = $temp;
        }

        yield from new ArrayIterator($shuffled);
    }
}
