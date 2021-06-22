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
     * @var array заданный массив
     */
    private $array = [];
    /**
     * Задать массив
     * @param array $array
     * @return self
     */
    public static function setArray($array)
    {
        $instance = new self;
        $instance->array = $array;
        return $instance;
    }
    /**
     * Получить заголовок
     * @return array
     */
    public function getHeader()
    {
        if (empty($this->array)) {
            return [];
        }

        return array_keys($this->array[0]);
    }
    /**
     * Получить тело
     * @return array
     */
    public function getBody()
    {
        if (empty($this->array)) {
            return [];
        }

        $body = [];
        foreach ($this->array as $row) {
            $body[] = array_values($row);
        }

        return $body;
    }
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
    /**
     * Парсинг json структуры
     * @param string $json
     * @param array $names наименование секций в структуре
     * @return array
     */
    public static function jsonStructure($json, $names = [])
    {
        $jsonObject = json_decode($json, true);

        return self::readStructure($jsonObject, $names, 0);
    }
    /**
     * Прочитать поля массива
     * @param array $object
     * @param array $names наименование секций в структуре
     * @param integer $i текущая читаемая секция
     * @return array
     */
    private static function readStructure($object, $names, $i)
    {
        if (!isset($names[$i])) {
            return [];
        }

        $structure = [];
        $structure[$names[$i]] = [];

        foreach ($object as $key => $value) {
            if (gettype($value) === 'array') {
                if (self::isSequential($value)) {
                    $structure = array_merge($structure, self::readStructure($value[0], $names, $i + 1));
                    break;
                }
                else {
                    $structure = array_merge($structure, self::readStructure($value, $names, $i + 1));
                }
            }
            else {
                $structure[$names[$i]][$key] = gettype($value);
            }
        }

        return $structure;
    }
    /**
     * Получает значение в массиве
     * @param string path
     * @return array
     */
    public static function getValue($array, $path = null)
    {
        if ($path === null) {
            return $array;
        }

        $path = explode('.', $path);

        $pointer = &$array;
        foreach ($path as $key) {
            if (!isset($pointer[$key])) return null;

            $pointer = &$pointer[$key];
        }

        return $pointer;
    }
    /**
     * Сцепление массивов
     * @param array $arr
     * @param array $join
     * @return array
     */
    public static function join($arr, $join)
    {
        $joinArr = [];

        foreach ($arr as $key => $value) {
            if (isset($join[$value])) {
                $joinArr[$key] = $join[$value];
            }
        }

        return $joinArr;
    }
}
