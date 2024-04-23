<?php

namespace Scores\Hook;

class ScoresHook
{
    public function handle(){
        echo view('wadmin-scores::blocks.sidebar');
    }
}
