Double-Array-Trie
==============

集成 Double Array Trie 到lumen中方便敏感词过滤

## Installation

You can install the package via composer:

```bash
composer require liugj/double-array-trie
```

You must add the Scout service provider and the package service provider in your `bootstrap/app.php` line 80 config:

```php
$app->register(Liugj\DoubleArray\TrieServiceProvider::class);
