<?php

namespace Scores\Models;
use Illuminate\Database\Eloquent\Model;
class Scores extends Model
{
    protected $table = 'test_scores';
    protected $fillable = [
        'identification_number',
        'cccd_number',
        'name',
        'gender',
        'birthday',
        'test_subject',
        'score_one_name',
        'score_one',
        'priority_score_one',
        'total_score_one',
        'score_two_name',
        'score_two',
        'priority_score_two',
        'total_score_two',
        'total_scores',
        'admission_year',
        'comment',
        'status',
    ];
}
