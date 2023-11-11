<?php

use HexagonDev\Core\Config;

if (!function_exists('env')) {
    function env(string $key, mixed $default = null) {
        return $_ENV[$key] ?? $default;
    }
}

if (!function_exists('getDot')) {
    function getDot($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }

        if (isset($array[$key])) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment)
        {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $default;
            }

            $array = $array[$segment];
        }

        return $array;
    }
}

if (!function_exists('config')) {
    function config(string $key, mixed $default = null)
    {
        return getDot(Config::get(), $key, $default);
    }
}

if (!function_exists('mb_basename')) {
    function mb_basename($path) {
        if (preg_match('@^.*[\\\\/]([^\\\\/]+)$@s', $path, $matches)) {
            return $matches[1];
        } else if (preg_match('@^([^\\\\/]+)$@s', $path, $matches)) {
            return $matches[1];
        }
        return '';
    }
}

if (!function_exists('dd')) {
    function dd(...$params)
    {
        print_r($params);

        die;
    }
}

if (!function_exists('json_response')) {
    function json_response($data)
    {
        return json_encode($data, JSON_THROW_ON_ERROR);
    }
}
