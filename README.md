Lazy Collection
===
[![Build Status](https://travis-ci.org/praswicaksono/lazy-collection.svg?branch=master)](https://travis-ci.org/praswicaksono/lazy-collection)

This collection implement [nikic/iter](https://github.com/nikic/iter) to provide lazy initialization and operation by using `Generator`

Installation
===

`composer require praswicaksono/lazy-collection dev-master`

Usage
===

Construct From Generator
---

```php
$iterable = function () {
    for ($i = 1; $i <= 5; $i++) {
        yield $i;
    }
};

$collection = IterableCollection::fromGenerator($iterable());
```

Construct From Array
---

```php
$collection = IterableCollection::fromArray([1, 2, 3, 4, 5]);
```

Example Usage
---

```php
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

// $result = 90
```

For more information, checkout the `test` suite.

Contribute
===

PRs are welcome!

License
===

MIT