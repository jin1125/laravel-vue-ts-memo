<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMemoRequest;
use App\Models\Memo;

class MemoController extends Controller
{
    public function create(CreateMemoRequest $request)
    {
        $memo = new Memo;
        $memo->title = $request->input('title');
        $memo->detail = $request->input('detail');
        $memo->limit = $request->input('limit');
        $memo->save();

        return redirect()->route('dashboard');
    }
}
