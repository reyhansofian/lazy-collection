<?php

namespace Test;

use LazyCollection\IterableCollection;

class IterableCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @tests
     */
    public function it_should_constructable_from_array()
    {
        $collection = IterableCollection::fromArray([1, 2, 3, 4, 5]);

        $this->assertInstanceOf(IterableCollection::class, $collection);
    }

    /**
     * @tests
     */
    public function it_should_constructable_from_iterable()
    {
        $iterable = function () {
            for ($i = 0; $i < 5; $i++) {
                yield $i;
            }
        };

        $collection = IterableCollection::fromGenerator($iterable());

        $this->assertInstanceOf(IterableCollection::class, $collection);
    }

    /**
     * @tests
     */
    public function it_should_to_map_collection()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i;
            }
        };

        $map = IterableCollection::fromGenerator($iterable())->map(function ($value) {
            return $value * 10;
        });

        $expectedValues = [10, 20, 30, 40, 50];

        $i = 0;
        foreach ($map as $value) {
            $this->assertEquals($expectedValues[$i], $value);
            $i++;
        }
    }

    /**
     * @tests
     */
    public function it_should_able_to_map_keys_collection()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i => 'a';
            }
        };

        $mapKeys = IterableCollection::fromGenerator($iterable())->mapKeys(function ($key) {
            return $key * 10;
        });

        $expectedValues = [10, 20, 30, 40, 50];

        $i = 0;
        foreach ($mapKeys as $key => $value) {
            $this->assertEquals($expectedValues[$i], $key);
            $i++;
        }
    }

    /**
     * @tests
     */
    public function it_should_able_to_reindex_collection()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield ['id' => $i * 10, 'value' => $i];
            }
        };

        $collection = IterableCollection::fromGenerator($iterable())->reindex(function ($value) {
            return $value['id'];
        });

        $expectedValues = [10, 20, 30, 40, 50];

        $i = 0;
        foreach ($collection as $key => $value) {
            $this->assertEquals($expectedValues[$i], $key);
            $i++;
        }
    }

    /**
     * @tests
     */
    public function it_should_able_to_apply_function_in_collection()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i * 10;
            }
        };

        $result = [];
        IterableCollection::fromGenerator($iterable())->apply(function ($value) use (&$result) {
            array_push($result, $value);
        });

        $expectedValues = [10, 20, 30, 40, 50];

        $i = 0;
        foreach ($result as $value) {
            $this->assertEquals($expectedValues[$i], $value);
            $i++;
        }
    }

    /**
     * @tests
     */
    public function it_should_able_to_filter_collection()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i * 10;
            }
        };

        $filteredCollection = IterableCollection::fromGenerator($iterable())->filter(function ($value) {
            return $value > 30;
        });

        $expectedValues = [40, 50];

        $i = 0;
        foreach ($filteredCollection as $value) {
            $this->assertEquals($expectedValues[$i], $value);
            $i++;
        }
    }

    /**
     * @tests
     */
    public function it_should_able_reduce_collection_to_one_value()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i;
            }
        };

        $reducedCollection = IterableCollection::fromGenerator($iterable())->reduce(function ($acc, $value, $key) {
            return $acc + $value;
        });

        $this->assertEquals(15, $reducedCollection);
    }

    /**
     * @tests
     */
    public function it_should_be_able_to_do_reductions_in_collection()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i;
            }
        };

        $reducedCollection = IterableCollection::fromGenerator($iterable())->reductions(function ($acc, $value, $key) {
            return $acc + $value;
        });

        $expectedValues = [1, 3, 6, 10, 15];

        $i = 0;
        foreach ($reducedCollection as $value) {
            $this->assertEquals($expectedValues[$i], $value);
            $i++;
        }
    }

    /**
     * @tests
     */
    public function it_should_able_to_zip_another_iterator()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i;
            }
        };

        $zippedCollection = IterableCollection::fromGenerator($iterable())->zip([6, 7, 8, 9, 0]);

        $expectedValues = [
            [1, 6],
            [2, 7],
            [3, 8],
            [4, 9],
            [5, 0]
        ];

        $i = 0;

        foreach ($zippedCollection as $value) {
            $this->assertEquals($expectedValues[$i], $value);
            $i++;
        }
    }

    /**
     * @tests
     */
    public function it_should_able_to_chain_with_another_iterator()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i;
            }
        };

        $iterable2 = function () {
            for ($i = 6; $i <= 10; $i++) {
                yield $i;
            }
        };

        $chainedCollection = IterableCollection::fromGenerator($iterable())->chain($iterable2());

        $expectedValues = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10
        ];

        $i = 0;

        foreach ($chainedCollection as $value) {
            $this->assertEquals($expectedValues[$i], $value);
            $i++;
        }
    }

    /**
     * @tests
     */
    public function it_should_able_to_take_certain_number_of_collection()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i;
            }
        };

        $collection = IterableCollection::fromGenerator($iterable())->take(2);

        $expectedValues = [1, 2];

        $i = 0;

        foreach ($collection as $value) {
            $this->assertEquals($expectedValues[$i], $value);
            $i++;
        }
    }

    /**
     * @tests
     */
    public function it_should_able_to_count_collection()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i;
            }
        };

        $collection = IterableCollection::fromGenerator($iterable());

        $this->assertEquals(5, count($collection));
    }

    /**
     * @tests
     */
    public function it_should_able_to_make_fluent_call()
    {
        $iterable = function () {
            for ($i = 1; $i <= 5; $i++) {
                yield $i;
            }
        };

        $result = IterableCollection::fromGenerator($iterable())
            ->map(function ($value) {
                return $value * 10;
            })
            ->filter(function ($value) {
                return $value > 30;
            })
            ->reduce(function ($acc, $value, $startValue) {
                return $acc + $value;
            });

        $this->assertEquals(90, $result);
    }
}
