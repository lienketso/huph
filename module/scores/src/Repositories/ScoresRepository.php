<?php

namespace Scores\Repositories;
use Prettus\Repository\Eloquent\BaseRepository;
use Scores\Models\Scores;

class ScoresRepository extends BaseRepository
{
    public function model()
    {
        return Scores::class;
    }
}
