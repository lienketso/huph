<?php

namespace App\Services;

class SEOScoringService
{
    public static function calculateSEOScore($content, $metaDescription)
    {
        $contentLength = str_word_count($content);

        // Điểm tối đa cho độ dài nội dung và mô tả
        $maxLengthScore = 50; // Giả sử nội dung tối đa là 1000 từ
        $maxDescriptionScore = 50; // Giả sử mô tả tối đa là 200 ký tự

        // Tính điểm độ dài nội dung
        $lengthScore = min(($contentLength / 10), $maxLengthScore);

        // Kiểm tra sự tồn tại và độ dài của mô tả
        $descriptionScore = 0;
        if (!empty($metaDescription)) {
            $descriptionLength = strlen($metaDescription);
            if ($descriptionLength > 0 && $descriptionLength <= 200) {
                $descriptionScore = $maxDescriptionScore;
            }
        }

        // Tính điểm tổng cộng
        $totalScore = $lengthScore + $descriptionScore;

        return $totalScore;
    }
}
