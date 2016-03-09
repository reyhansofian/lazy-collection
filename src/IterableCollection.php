<?php

namespace PrasWicaksono\LazyCollection;

/**
 * Class IterableCollection
 * @package PrasWicaksono\LazyCollection
 */
final class IterableCollection implements Collection
{
    /**
     * @var array|\Traversable
     */
    private $elements;

    /**
     * @param $elements array|\Traversable
     */
    private function __construct($elements)
    {
        \iter\_assertIterable($elements, 'Argument');
        $this->elements = $elements;
    }

    /**
     * @param array $elements
     * @return IterableCollection
     */
    public static function fromArray(array $elements) : IterableCollection
    {
        return new static($elements);
    }

    /**
     * @param \Generator $elements
     * @return IterableCollection
     */
    public static function fromGenerator(\Generator $elements) : IterableCollection
    {
        return new static($elements);
    }

    /**
     * {@inheritdoc}
     */
    public function map(callable $function) : Collection
    {
        $this->elements = \iter\map($function, \iter\toIter($this->elements));
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function mapKeys(callable $function) : Collection
    {
        $this->elements = \iter\mapKeys($function, \iter\toIter($this->elements));
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reindex(callable $function) : Collection
    {
        $this->elements = \iter\reindex($function, \iter\toIter($this->elements));
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(callable $function)
    {
        \iter\apply($function, \iter\toIter($this->elements));
    }

    /**
     * {@inheritdoc}
     */
    public function filter(callable $predicate) : Collection
    {
        $this->elements = \iter\filter($predicate, \iter\toIter($this->elements));

        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reduce(callable $function, $startValue = null)
    {
        return \iter\reduce($function, \iter\toIter($this->elements), $startValue);
    }

    /**
     * {@inheritdoc}
     */
    public function reductions(callable $function, $startValue = null) : Collection
    {
        $this->elements = \iter\reductions($function, \iter\toIter($this->elements), $startValue);
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function zip(...$iterables) : Collection
    {
        $this->elements = \iter\zip(\iter\toIter($this->elements), ...$iterables);
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function chain(...$iterables) : Collection
    {
        $this->elements = \iter\chain(\iter\toIter($this->elements), ...$iterables);
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function drop(int $num) : Collection
    {
        $this->elements = \iter\slice(\iter\toIter($this->elements), $num);
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function search(callable $predicate)
    {
        return \iter\search($predicate, \iter\toIter($this->elements));
    }

    /**
     * {@inheritdoc}
     */
    public function flatten() : Collection
    {
        $this->elements = \iter\flatten(\iter\toIter($this->elements));
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function flip() : Collection
    {
        $this->elements = \iter\flip(\iter\toIter($this->elements));
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function chunk(int $size) : Collection
    {
        $this->elements = \iter\chunk(\iter\toIter($this->elements), $size);
        return clone $this;
    }

    /**
     * {@inheritdoc}
     */
    public function join(string $separator) : string
    {
        return \iter\join($separator, \iter\toIter($this->elements));
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->toArray());
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return \iter\toIter($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return \iter\toArrayWithKeys($this->elements);
    }
}
