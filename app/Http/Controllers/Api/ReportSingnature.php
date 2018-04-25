<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Singature;

class ReportSingnature extends Controller
{
  public function update(Singature $singature)
  {
    $singature->flag();

    return $singature;
  }
}
