<?php

namespace App\Services;

class CurrencyService
{
    protected $accessKey;

    public function __construct()
    {
        
    }

    public function convertCurrency()
    {
        // Tạo URL
        $url = 'https://data.fixer.io/api/latest?access_key=bbd79a69dd2944e2921496de36f95aac&format=1';

        // Khởi tạo cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Lấy dữ liệu JSON từ API
        $json = curl_exec($ch);
        curl_close($ch);

        // Giải mã JSON
        $conversionResult = json_decode($json, true);

        // Kiểm tra kết quả và trả về
        if (isset($conversionResult['rates'])) {
            return $conversionResult['rates'];  // Trả về mảng tỷ giá
        } else {
            // Xử lý lỗi nếu có
            return null;
        }
    }
}
