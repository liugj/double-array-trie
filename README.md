Double-Array-Trie
==============

Add `Double Array Trie` in `Lumen` to filter sensitive words

## Installation

You can install the package via composer:

```bash
composer require liugj/double-array-trie
```

You must add the Trie service provider and the package service provider in your `bootstrap/app.php` line 80 config:

```php
$app->register(Liugj\DoubleArray\TrieServiceProvider::class);


```
You must add double-array-trie.php in  your `config` directory

```php
return [
   'dest' => resoure_path(). '/pingbi.dat',  //Double Array path
   'src'  =>  resoure_path(). '/pingbi.txt'  //Sensitive words one word per line
];
```


