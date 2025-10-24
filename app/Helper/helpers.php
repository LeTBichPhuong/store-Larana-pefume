<?php

namespace App\Helper;

class helpers
{
    /**
     * Chuyển giá từ chuỗi "4.300.000 ₫" sang số thực 4300000
     *
     * @param string $priceString
     * @return float
     */
    public static function parse(string $priceString): float
    {
        // Loại bỏ dấu chấm, khoảng trắng, ký hiệu tiền
        $number = str_replace(['.', ' ', '₫'], '', $priceString);
        return (float) $number;
    }

    /**
     * Định dạng số thành chuỗi tiền tệ Việt Nam "4.300.000 ₫"
     *
     * @param float|int $number
     * @return string
     */
    public static function format(float|int $number): string
    {
        return number_format($number, 0, ',', '.') . ' ₫';
    }
}