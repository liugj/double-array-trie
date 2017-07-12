<?php

/*
 * This file is part of the double array trie  php package.
 *
 * (c) liugj <liugj@boqii.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liugj\DoubleArray;

class Trie
{
    /**
     * Double Array tree.
     *
     * @var mixed
     */
    protected $tree = null;
    /**
     * 存放路径 dest.
     *
     * @var mixed
     */
    protected $dest;
    /**
     * 原词存放路径 src.
     *
     * @var mixed
     */
    protected $src;

    /**
     * 构造函数__construct.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->tree = null;
        $this->dest = $options['dest'];
        $this->src = $options['src'];
    }

    /**
     * 保存 saveFromArray.
     *
     * @param array $words 敏感词列表
     *
     * @return mixed
     */
    public function saveFromArray(array $words = array())
    {
        $this->tree = trie_filter_new();
        foreach ($words as $word) {
            trie_filter_store($this->tree, $word);
        }

        return trie_filter_save($this->tree, $this->dest);
    }

    /**
     * 保存saveFromFile.
     *
     * @param string $filename
     *
     * @return mixed
     */
    public function saveFromFile(string $filename = '')
    {
        if (!file_exists($filename)) {
            throw new Exception\FileNotExistsException();
        }
        if (!is_readable($filename)) {
            throw new Exception\FileUnableReadException();
        }
        if (!is_writable($this->dest)) {
            throw new Exception\FileUnableWriteException();
        }
        $fp = fopen($filename, 'r');
        if (!$fp) {
            throw new Exception\FileOpenException();
        }

        $this->tree = trie_filter_new();
        while ($word = fgets($fp, 1024)) {
            $word = trim($word);
            if (!$word) {
                continue;
            }

            trie_filter_store($this->tree, $word);
        }
        fclose($fp);

        return trie_filter_save($this->tree, $this->dest);
    }

    /**
     * 加载 load.
     *
     *
     *
     * @return mixed
     */
    protected function load()
    {
        $this->tree = trie_filter_load($this->dest);
    }

    /**
     * 查找 search.
     *
     * @param string $content
     *
     * @return array
     */
    public function search(string $content = '') : array
    {
        file_exists($this->dest) ?: $this->saveFromFile($this->src);
        $this->load();

        return trie_filter_search($this->tree, $content);
    }

    /**
     * 查找全部 searchAll.
     *
     * @param string $content 待查找内容
     *
     * @return array
     */
    public function searchAll(string $content = ''): array
    {
        file_exists($this->dest) ?: $this->saveFromFile($this->src);
        $this->load();

        return trie_filter_search_all($this->tree, $content);
    }

    /**
     * 替换 replaceAll.
     *
     * @param string $content 待替换内容
     * @param string $replace 敏感词替换词
     *
     * @return string
     */
    public function replaceAll(string $content = '', string $replace = '*'): string
    {
        $positions = $this->searchAll($content);
        if (!$positions) {
            return $content;
        }
        $startPos = [];
        $endPos = [];

        foreach ($positions as list($start, $offset)) {
            if (isset($startPos[$start])) {
                $startPos[$start][] = $offset;
            } else {
                $startPos[$start] = array($offset);
            }
            $end = $start + $offset;

            if (isset($endPos[$end])) {
                $endPos[$end][] = $offset;
            } else {
                $endPos[$end] = array($offset);
            }
        }
        foreach ($endPos as $end => $values) {
            $max = max($values);
            for ($i = $end - 1; $i >= $end - $max; $i--) {
                $content[$i] = $replace;
            }
        }

        foreach ($startPos as $start => $values) {
            $max = max($values);
            for ($i = $start; $i < $start + $max; $i++) {
                $content[$i] = $replace;
            }
        }

        return $content;
    }

    /**
     * 释放内存__destruct.
     */
    public function __destruct()
    {
        if ($this->tree) {
            trie_filter_free($this->tree);
        }
    }
}
