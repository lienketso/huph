<?php

namespace Reports\Hook;

class ReportsHook
{
    public function handle(){
        echo view('wadmin-reports::blocks.sidebar');
    }
}
