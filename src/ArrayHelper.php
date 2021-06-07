<?php

namespace sagittaracc;

/**
 * This is me array helper
 * I use it for sagittaracc/suql
 * 
 * @author sagittaracc <sagittaracc@gmail.com>
 */
class ArrayHelper
{
    /**
     * Строит срез массива по набору ключей
     * @param array $array
     * @param array $key
     * @return array
     */
    public static function slice_by_keys($array, $keys)
    {
        if (!is_array($array) || !is_array($keys))
            return null;

        if (empty($keys))
            return [];

        return array_intersect_key($array, array_fill_keys($keys, 0));
    }
    /**
     * Переиндексирует исходный массив новым набором ключей
     * @param array $array
     * @param array $new_keys
     * @return array
     */
    public static function rename_keys($array, $new_keys)
    {
        $old_keys = array_keys($array);

        if (count($old_keys) !== count($new_keys)) {
            return null;
        }

        return array_combine($new_keys, array_values($array));
    }
    /**
     * Проверяет если исходный массив is sequential
     * @param array $array
     * @return boolean
     */
    public static function isSequential($array)
    {
        return array_keys($array) === range(0, count($array) - 1);
    }
    /**
     * Индексирует входной массив по набору ключей
     * @param string|array $option
     * @param array $array
     * @param boolean $group признак группировки или индексации
     * @return array
     */
    public static function index($option, $array, $group = false)
    {
        $indexArr = [];
        $pointer = null;

        if (is_string($option)) {
            $simpleIndex = $option;

            foreach ($array as $row) {
                $group
                    ? $indexArr[$row[$simpleIndex]][] = $row
                    : $indexArr[$row[$simpleIndex]] = $row;
            }
        }
        else if (is_array($option)) {
            $multiIndex = $option;

            foreach ($array as $row) {
                $pointer = &$indexArr;

                foreach ($multiIndex as $index) {
                    if (!isset($pointer[$row[$index]])) {
                        $pointer[$row[$index]] = [];
                    }

                    $pointer = &$pointer[$row[$index]];
                }

                $group
                    ? $pointer[] = $row
                    : $pointer = $row;
            }
        }

        return $indexArr;
    }
    /**
     * Группировка исходного массива по набору ключей
     * @param string|array $option
     * @param array $array
     * @return array
     */
    public static function group($option, $array)
    {
        return self::index($option, $array, true);
    }
}
