<?php

namespace App\Services;

use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

class GetMemoService
{
    public function execute()
    {
      $sortOrder = 'DESC';
      return Memo::where('user_id', '=', Auth::id())
          ->orderBy('id', $sortOrder)
          ->get();
    }
}