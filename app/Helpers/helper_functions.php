<?php

use App\Enums\Page;
use App\Enums\Section;
use App\Models\CMS;

function getFileName($file): string
{
    return time().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
}


