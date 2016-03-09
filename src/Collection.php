<?php

namespace PrasWicaksono\LazyCollection;

use Countable;
use IteratorAggregate;

/**
 * Interface Collection
 * @package PrasWicaksono\LazyCollection
 */
interface Collection extends Countable, IteratorAggregate
{
    /**
     * @param callable $function
     * @return Collection
     */
    public function map(callable $function) : Collection;

    /**
     * @param callable $function
     * @return Collection
     */
    public function mapKeys(callable $function) : Collection;

    /**
     * @param callable $function
     * @return Collection
     */
    public function reindex(callable $function) : Collection;

    /**
     * @param callable $function
     * @return void
     */
    public function apply(callable $function);

    /**
     * @param callable $predicate
     * @return Collection
     */
    public function filter(callable $predicate) : Collection;

    /**
     * @param callable $function
     * @param null $startValue
     * @return mixed
     */
    public function reduce(callable $function, $startValue = null);

    /**
     * @param callable $function
     * @param null $startValue
     * @return Collection
     */
    public function reductions(callable $function, $startValue = null) : Collection;

    /**
     * @param array[]|\Traversable
     * @return Collection
     */
    public function zip(...$iterables) : Collection;

    /**
     * @param array[]|\Traversable
     * @return Collection
     */
    public function chain(...$iterables) : Collection;

    /**
     * @param array[]|\Traversable
     * @return Collection
     */
    public function product(...$iterables) : Collection;

    /**
     * @param int $num
     * @return Collection
     */
    public function take(int $num) : Collection;

    /**
     * @param int $num
     * @return Collection
     */
    public function drop(int $num) : Collection;

    /**
     * @param callable $function
     * @return mixed
     */
    public function search(callable $function);

    /**
     * @return Collection
     */
    public function flatten() : Collection;

    /**
     * @return Collection
     */
    public function flip() : Collection;

    /**
     * @param int $size
     * @return Collection
     */
    public function chunk(int $size) : Collection;

    /**
     * @param string $seperator
     * @return string
     */
    public function join(string $seperator) : string;

    /**
     * @return array
     */
    public function toArray() : array;
}
