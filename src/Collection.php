<?php

namespace PrasWicaksono\LazyCollection;

use Countable;
use IteratorAggregate;

interface Collection extends Countable, IteratorAggregate
{
    public function map(callable $function) : Collection;

    public function mapKeys(callable $function) : Collection;

    public function reindex(callable $function) : Collection;

    public function apply(callable $function);

    public function filter(callable $predicate) : Collection;

    public function reduce(callable $function, $startValue = null);

    public function reductions(callable $function, $startValue = null) : Collection;

    public function zip(...$iterables) : Collection;

    public function chain(...$iterables) : Collection;

    public function product(...$iterables) : Collection;

    public function take(int $num) : Collection;

    public function drop(int $num) : Collection;

    public function search(callable $function);

    public function flatten() : Collection;

    public function flip() : Collection;

    public function chunk(int $size) : Collection;

    public function join(string $seperator) : string;

    public function toArray() : array;
}
