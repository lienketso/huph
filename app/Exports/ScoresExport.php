<?php

namespace App\Exports;

use Scores\Models\Scores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class ScoresExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Scores::all();
    }

    public function headings(): array
    {
        return [
            'Số báo danh',
            'CCCD',
            'Họ và tên',
            'Giới',
            'Ngày tháng năm sinh',
            'Đối tượng dự thi',
            'Tên môn thi 1',
            'Điểm môn thi 1',
            'Điểm ưu tiên môn thi 1',
            'Tổng điểm môn thi 1',
            'Tên môn thi 2',
            'Điểm môn thi 2',
            'Điểm ưu tiên môn thi 2',
            'Tổng điểm môn thi 2',
            'Tổng điểm xét tuyển (đã bao gồm điểm ưu tiên nếu có)',
            'Ghi chú',
            ' Trạng thái (Đỗ/trượt/Xem điểm)',
        ];
    }

    // Tuỳ chỉnh dữ liệu cho từng hàng
    public function map($user): array
    {
        return [
            $user->identification_number,
            $user->cccd_number,
            $user->name,
            $user->gender,
            $user->birthday,
            $user->test_subject,
            $user->score_one_name,
            $user->score_one,
            $user->priority_score_one,
            $user->total_score_one,
            $user->score_two_name,
            $user->score_two,
            $user->priority_score_two,
            $user->total_score_two,
            $user->total_scores,
            $user->comment,
            $user->status
        ];
    }

    // Định dạng các ô, bôi đậm tiêu đề
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Bôi đậm dòng 1 (tiêu đề)
        ];
    }

}
