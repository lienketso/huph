<?php

namespace Scores\Models;
use Illuminate\Database\Eloquent\Model;
class Scores extends Model
{
    protected $table = 'test_scores';
    protected $fillable = [
        'name',
        'identification_number',
        'cccd_number',
        'birthday',
        'test_subject',
        'biology_scores',
        'priority_biology_scores',
        'math_scores',
        'priority_math_scores',
        'english_scores',
        'priority_english_scores',
        'epidemiological_scores',
        'priority_epidemiological_scores',
        'health_management_scores',
        'priority_health_management_scores',
        'biochemistry_hematology_scores',
        'priority_biochemistry_hematology_scores',
        'food_safety_scores',
        'priority_food_safety_scores',
        'total_scores',
        'admission_year',
        'comment',
        'gender',
        'industry_code',
        'status'
    ];
}
