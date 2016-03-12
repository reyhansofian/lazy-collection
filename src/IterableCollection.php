<?php

namespace LazyCollection\LazyCollection;

/**
 * Class IterableCollection
 * @package LazyCollection\LazyCollection
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
     * @throws
     */
    public static function fromArray(array $elements)
    {
        $static = new static($elements);

        if (!$static instanceof IterableCollection) {
            throw new \Exception('Not instance of IterableCollection');
        }

        return $static;
    }

    /**
     * @param \Generator $elements
     * @return IterableCollection
     * @throws
     */
    public static function fromGenerator(\Generator $elements)
    {
        $static = new static($elements);

        if (!$static instanceof IterableCollection) {
            throw new \Exception('Not instance of IterableCollection');
        }

        return $static;
    }

    /**
     * {@inheritdoc}
     */
    public function map(callable $function)
    {
        $this->elements = \iter\map($function, \iter\toIter($this->elements));
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function mapKeys(callable $function)
    {
        $this->elements = \iter\mapKeys($function, \iter\toIter($this->elements));
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function reindex(callable $function)
    {
        $this->elements = \iter\reindex($function, \iter\toIter($this->elements));
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
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
    public function filter(callable $predicate)
    {
        $this->elements = \iter\filter($predicate, \iter\toIter($this->elements));
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
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
    public function reductions(callable $function, $startValue = null)
    {
        $this->elements = \iter\reductions($function, \iter\toIter($this->elements), $startValue);
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function zip(...$iterables)
    {
        $this->elements = \iter\zip(\iter\toIter($this->elements), ...$iterables);
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function chain(...$iterables)
    {
        $this->elements = \iter\chain(\iter\toIter($this->elements), ...$iterables);
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function product(...$iterables)
    {
        $this->elements = \iter\chain(\iter\toIter($this->elements), ...$iterables);
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    public function take($num)
    {
        if (!is_int($num)) {
            throw new \Exception('Must be integer');
        }

        $this->elements = \iter\slice(\iter\toIter($this->elements), 0, $num);
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function drop($num)
    {
        if (!is_int($num)) {
            throw new \Exception('Must be integer');
        }

        $this->elements = \iter\slice(\iter\toIter($this->elements), $num);
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
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
    public function flatten()
    {
        $this->elements = \iter\flatten(\iter\toIter($this->elements));
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function flip()
    {
        $this->elements = \iter\flip(\iter\toIter($this->elements));
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function chunk($size)
    {
        if (!is_int($size)) {
            throw new \Exception('Must be integer');
        }

        $this->elements = \iter\chunk(\iter\toIter($this->elements), $size);
        $that = clone $this;

        if (!$that instanceof Collection) {
            throw new \Exception('Not instance of Collection');
        }

        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function join($separator)
    {
        if (!is_string($separator)) {
            throw new \Exception('Must be string');
        }

        $joinSeparator = \iter\join($separator, \iter\toIter($this->elements));

        if (!is_string($joinSeparator)) {
            throw new \Exception('Must be string');
        }

        return $joinSeparator;
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
    public function toArray()
    {
        $toArray = \iter\toArrayWithKeys($this->elements);

        if (!is_array($toArray)) {
            throw new \Exception('Must be array');
        }

        return $toArray;
    }
}
