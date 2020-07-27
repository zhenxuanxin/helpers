<?php

if (!function_exists('json2array')) {
    /**
     * 将 JSON 字符串反序列化为数组
     * @param string $string
     * @return mixed
     */
    function json2array($string)
    {
        return json_decode($string, true);
    }
}

if (!function_exists('array2json')) {
    /**
     * 将数组序列化为 JSON 字符串
     * @param array $array
     * @return false|string
     */
    function array2json($array)
    {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('cny')) {
    /**
     * 格式化数值为人民币的格式
     * @param string|integer|float $amount 数值
     * @param bool $float 是否返回浮点数
     * @param string $prefix 前缀
     * @param string $suffix 后缀
     * @return float|string
     */
    function cny($amount, $float = false, $prefix = '', $suffix = '')
    {
        $value = number_format($amount / 100.0, 2);
        if ($float) {
            return floatval($value);
        }

        return $prefix . $value . $suffix;
    }
}

if (!function_exists('bytes')) {
    function bytes($size, $precision = 2)
    {
        $unit = ['', 'K', 'M', 'G', 'T', 'P'];
        $base = 1024;
        $i = floor(log($size, $base));
        $n = count($unit);
        if ($i >= $n) {
            $i = $n - 1;
        }

        return round($size / pow($base, $i), $precision) . ' ' . $unit[$i] . 'B';
    }
}

if (!function_exists('public_url')) {
    /**
     * 返回静态文件的完整的 URL 地址
     * @param $path string 静态文件实际存放的地址
     * @return string
     */
    function public_url($path)
    {
        if (URL::isValidUrl($path)) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }
}

if (!function_exists('h5_cookie')) {
    /**
     * 自动将域名设置为当前域的上一级域，同时自动设置 HTTPS
     */
    function h5_cookie($name, $value, $httpOnly = true, $forget = false) {
        $path = '/';
        $domain = Str::after(Request::server('SERVER_NAME'), '.');
        if ($forget) {
            return Cookie::forget($name, $path, $domain);
        }

        $secure = Request::secure();
        return Cookie::make($name, $value, 0, $path, $domain, $secure, $httpOnly);
    }
}
