<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMemoRequest;
use App\Models\Memo;

class MemoController extends Controller
{
    public function create(CreateMemoRequest $request)
    {
        $memo = $request->all();

        dd($memo);
    }
}
