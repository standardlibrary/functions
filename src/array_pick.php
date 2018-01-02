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
        $index = count($shuffled);

        while ($index--) {
            $random = floor(rand() % $index);
            $temp = $array[$index];

            $array[$index] = $array[$random];
            $array[$random] = $temp;
        }

        yield from new ArrayIterator($shuffled);
    }
}
