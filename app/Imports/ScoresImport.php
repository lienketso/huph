<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Scores\Models\Scores;

class ScoresImport implements ToModel
{
    /**
    * @param Collection $collection
    */

    private $rowCount = 0;


    public function model(array $row)
    {
        // Tăng số dòng đã được đọc
        $this->rowCount++;

        // Kiểm tra xem dòng đó có phải là dòng đầu tiên không
        if ($this->rowCount === 1) {
            // Nếu là dòng đầu tiên, trả về null để bỏ qua
            return null;
        }

        return new Scores([
            'identification_number'=> (!empty($row[0]) ? $row[0] : "0"),
            'name'     => (!empty($row[1]) ? $row[1] : "-"),
            'birthday' => (!empty($row[2]) ? $row[2] : "-"),
            'test_subject' => (!empty($row[3]) ? $row[3] : "-"),
            'score_one' => (!empty($row[4]) ? $row[4] : ""),
            'priority_score_one' => (!empty($row[5]) ? $row[5] : ""),
            'biology_scores' => (!empty($row[6]) ? $row[6] : ""),
            'priority_biology_scores' => (!empty($row[7]) ? $row[7] : ""),
            'math_scores' => (!empty($row[8]) ? $row[8] : ""),
            'priority_math_scores' => (!empty($row[9]) ? $row[9] : ""),
            'english_scores' => (!empty($row[10]) ? $row[10] : ""),
            'priority_english_scores' => (!empty($row[11]) ? $row[11] : ""),
            'epidemiological_scores' => (!empty($row[12]) ? $row[12] : ""),
            'priority_epidemiological_scores' => (!empty($row[13]) ? $row[13] : ""),
            'health_management_scores' => (!empty($row[14]) ? $row[14] : ""),
            'priority_health_management_scores' => (!empty($row[15]) ? $row[15] : ""),
            'biochemistry_hematology_scores' => (!empty($row[16]) ? $row[16] : ""),
            'priority_biochemistry_hematology_scores' => (!empty($row[17]) ? $row[17] : ""),
            'food_safety_scores' => (!empty($row[18]) ? $row[18] : ""),
            'priority_food_safety_scores' => (!empty($row[19]) ? $row[19] : ""),
            'total_scores' => (!empty($row[20]) ? $row[20] : ""),
            'comment' => (!empty($row[21]) ? $row[21] : "-"),
            'cccd_number' => (!empty($row[22]) ? $row[22] : "-"),
            'industry_code' => (!empty($row[23]) ? $row[23] : "-"),
            'status' => (!empty($row[24]) ? $row[24] : "pending"),
        ]);
    }
}
