<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemoRequest;
use App\Models\Memo;
use Inertia\Inertia;

class MemoController extends Controller
{
    public function index()
    {
        $memos = Memo::all();

        return Inertia::render('Dashboard', ['memos' => $memos]);
    }

    public function create(CreateMemoRequest $request)
    {
        Memo::create([
            'title'  => $request->input('title'),
            'detail' => $request->input('detail'),
            'limit'  => $request->input('limit'),
        ]);

        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        return Inertia::render('Edit', ['id' => $id]);
    }
}
