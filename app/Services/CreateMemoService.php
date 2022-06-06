<?php

namespace App\Services;

use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

class CreateMemoService
{
    public function execute($request)
    {
        Memo::create([
            'title'   => $request->input('title'),
            'status'  => $request->input('status'),
            'detail'  => $request->input('detail'),
            'limit'   => $request->input('limit'),
            'user_id' => Auth::id(),
        ]);
    }
}