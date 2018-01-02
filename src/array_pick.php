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

    define('STDLIB_OPTIMIZE_ARRAY', 2);
    define('STDLIB_SAVE_INDEXES', 4);

    /**
     * Pick random elements from an array
     *
     * Based on a partial Richard Durstenfeld’s Fisher-Yates shuffle, this
     * function performs a shuffle on up to $limit elements where $limit is the
     * number of random elements you want to pick. It will also work on
     * associative arrays and sparse arrays.
     * Use the (optional) STDLIB_OPTIMIZE_ARRAY flag to optimize sparse arrays
     * before processing. Add the STDLIB_SAVE_INDEXES flag to preserve indexes
     * where possible during optimization.
     *
     * @param array $array - The array to pick random elements from.
     * @param int $limit - The maximum quantity of elements to pick.
     * @param int $flags - Optional bitwise flags.
     * @return Iterator - Returns a PHP generator to iterate over the picked elements.
     */
    function array_pick(array $array, int $limit = null, int $flags = STDLIB_SAVE_INDEXES): Iterator
    {
        // Optimize array, removing indexes if specified
        if ($flags & STDLIB_OPTIMIZE_ARRAY) {
            $array = SplFixedArray::fromArray(
                $array,
                ($flags & STDLIB_SAVE_INDEXES ? true : false)
            );
        }

        // Grab all the keys from the array
        $array_keys = array_keys($array);

        // Get last index (key)
        end($array);
        $max_index = key($array);

        // Limit quantity of picked items to $limit or the entire array
        $iterations = min(($limit ?? count($array_keys)), count($array_keys));

        // Initialise an empty array set to required size
        $random_array = [];

        while($iterations--) {
            // Choose random index between zero and $max_index
            $index = mt_rand(0, $max_index);

            // Grab the key at the index
            $value = $array_keys[$index];

            // Swap the value of $index with $max_index
            $array_keys[$index] = $array_keys[$max_index];

            // Push the value at $index to the $random_array
            array_push($random_array, $array[$value]);

            // Decrease $max_index so it can never be reached again
            $max_index--;
        }

        yield from new ArrayIterator($random_array);
    }
}
