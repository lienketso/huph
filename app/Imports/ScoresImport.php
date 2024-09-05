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
            'identification_number'=> (!empty($row[0]) ? $row[0] : "0"), // số báo danh
            'cccd_number' => (!empty($row[1]) ? $row[1] : "-"),
            'name'     => (!empty($row[2]) ? $row[2] : "-"), // Họ và tên
            'gender'     => (!empty($row[3]) ? $row[3] : "-"), // Giới tính
            'birthday' => (!empty($row[4]) ? $row[4] : "-"), // Ngày sinh
            'test_subject' => (!empty($row[5]) ? $row[5] : "-"), //Đối tượng dự thi
            'score_one_name' => (!empty($row[6]) ? $row[6] : ""), // Tên môn thi 1
            'score_one' => (!empty($row[7]) ? $row[7] : ""), // Điểm thi môn 1
            'priority_score_one' => (!empty($row[8]) ? $row[8] : ""), // Điểm ưu tiên môn 1
            'total_score_one' => (!empty($row[9]) ? $row[9] : ""), // Tổng điểm môn thi 1
            'score_two_name' => (!empty($row[10]) ? $row[10] : ""), // Tên môn thi 2
            'score_two' => (!empty($row[11]) ? $row[11] : ""), //Điểm môn thi 2
            'priority_score_two' => (!empty($row[12]) ? $row[12] : ""), //Điểm ưu tiên môn 2
            'total_score_two' => (!empty($row[13]) ? $row[13] : ""), // Tổng điểm môn 2
            'total_scores' => (!empty($row[14]) ? $row[14] : ""), //Tổng điểm xét tuyển
            'comment' => (!empty($row[15]) ? $row[15] : "-"), //Ghi chú
            'status' => (!empty($row[16]) ? $row[16] : "pending"), //Trạng thái
        ]);
    }
}
