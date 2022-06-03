<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemoRequest;
use App\Models\Memo;
use Inertia\Inertia;

class MemoController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard');
    }

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
