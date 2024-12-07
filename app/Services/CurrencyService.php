<?php

namespace App\Services;

class CurrencyService
{
    public function __construct() {}

    public function convertCurrency()
    {
        // Tạo URL
        $url = 'https://v6.exchangerate-api.com/v6/5a5c6acf5dd7289a52bc3eea/latest/VND';

        // Khởi tạo cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Lấy dữ liệu JSON từ API
        $json = curl_exec($ch);
        curl_close($ch);

        // Giải mã JSON
        $conversionResult = json_decode($json, true);

        // Kiểm tra kết quả và trả về
        if (isset($conversionResult['conversion_rates'])) {
            return $conversionResult['conversion_rates'];  // Trả về mảng tỷ giá
        } else {
            // Xử lý lỗi nếu có
            return null;
        }
    }
}
