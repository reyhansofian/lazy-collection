<?php

namespace LazyCollection\LazyCollection;

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
    public function map(callable $function);

    /**
     * @param callable $function
     * @return Collection
     */
    public function mapKeys(callable $function);

    /**
     * @param callable $function
     * @return Collection
     */
    public function reindex(callable $function);

    /**
     * @param callable $function
     * @return void
     */
    public function apply(callable $function);

    /**
     * @param callable $predicate
     * @return Collection
     */
    public function filter(callable $predicate);

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
    public function reductions(callable $function, $startValue = null);

    /**
     * @param array[]|\Traversable
     * @return Collection
     */
    public function zip(...$iterables);

    /**
     * @param array[]|\Traversable
     * @return Collection
     */
    public function chain(...$iterables);

    /**
     * @param array[]|\Traversable
     * @return Collection
     */
    public function product(...$iterables);

    /**
     * @param int $num
     * @return Collection
     */
    public function take($num);

    /**
     * @param int $num
     * @return Collection
     */
    public function drop($num);

    /**
     * @param callable $function
     * @return mixed
     */
    public function search(callable $function);

    /**
     * @return Collection
     */
    public function flatten();

    /**
     * @return Collection
     */
    public function flip();

    /**
     * @param int $size
     * @return Collection
     */
    public function chunk($size);

    /**
     * @param string $seperator
     * @return string
     */
    public function join($seperator);

    /**
     * @return array
     */
    public function toArray();
}
