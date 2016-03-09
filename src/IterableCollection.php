<?php

namespace PrasWicaksono\LazyCollection;

use Generator;

class IterableCollection implements Collection
{
    private $elements;

    private function __construct($elements)
    {
        \iter\_assertIterable($elements, 'Argument');
        $this->elements = $elements;
    }

    public static function fromArray(array $elements) : IterableCollection
    {
        return new static($elements);
    }

    public static function fromGenerator(Generator $elements) : IterableCollection
    {
        return new static($elements);
    }

    public function map(callable $function) : Collection
    {
        $this->elements = \iter\map($function, \iter\toIter($this->elements));
        return clone $this;
    }

    public function mapKeys(callable $function) : Collection
    {
        $this->elements = \iter\mapKeys($function, \iter\toIter($this->elements));
        return clone $this;
    }

    public function reindex(callable $function) : Collection
    {
        $this->elements = \iter\reindex($function, \iter\toIter($this->elements));
        return clone $this;
    }

    public function apply(callable $function)
    {
        \iter\apply($function, \iter\toIter($this->elements));
    }

    public function filter(callable $predicate) : Collection
    {
        $this->elements = \iter\filter($predicate, \iter\toIter($this->elements));

        return clone $this;
    }

    public function reduce(callable $function, $startValue = null)
    {
        return \iter\reduce($function, \iter\toIter($this->elements), $startValue);
    }

    public function reductions(callable $function, $startValue = null) : Collection
    {
        $this->elements = \iter\reductions($function, \iter\toIter($this->elements), $startValue);
        return clone $this;
    }

    public function zip(...$iterables) : Collection
    {
        $this->elements = \iter\zip(\iter\toIter($this->elements), ...$iterables);
        return clone $this;
    }

    public function chain(...$iterables) : Collection
    {
        $this->elements = \iter\chain(\iter\toIter($this->elements), ...$iterables);
        return clone $this;
    }

    public function product(...$iterables) : Collection
    {
        $this->elements = \iter\chain(\iter\toIter($this->elements), ...$iterables);
        return clone $this;
    }

    public function take(int $num) : Collection
    {
        $this->elements = \iter\slice(\iter\toIter($this->elements), 0, $num);
        return clone $this;
    }

    public function drop(int $num) : Collection
    {
        $this->elements = \iter\slice(\iter\toIter($this->elements), $num);
        return clone $this;
    }

    public function search(callable $predicate)
    {
        return \iter\search($predicate, \iter\toIter($this->elements));
    }

    public function flatten() : Collection
    {
        $this->elements = \iter\flatten(\iter\toIter($this->elements));
        return clone $this;
    }

    public function flip() : Collection
    {
        $this->elements = \iter\flip(\iter\toIter($this->elements));
        return clone $this;
    }

    public function chunk(int $size) : Collection
    {
        $this->elements = \iter\chunk(\iter\toIter($this->elements), $size);
        return clone $this;
    }

    public function join(string $separator) : string
    {
        return \iter\join($separator, \iter\toIter($this->elements));
    }

    public function count()
    {
        return count($this->toArray());
    }

    public function getIterator()
    {
        return \iter\toIter($this->elements);
    }

    public function toArray() : array
    {
        return \iter\toArrayWithKeys($this->elements);
    }
}
