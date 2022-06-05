<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemoRequest;
use App\Models\Memo;
use Inertia\Inertia;

class MemoController extends Controller
{
    public function index()
    {
        $memos = Memo::all();

        return Inertia::render('Index', ['memos' => $memos]);
    }

    public function create(MemoRequest $request)
    {
        Memo::create([
            'title'  => $request->input('title'),
            'status' => $request->input('status'),
            'detail' => $request->input('detail'),
            'limit'  => $request->input('limit'),
        ]);

        return redirect()->route('memo.index');
    }

    public function edit($id)
    {
        $memo = Memo::find($id);

        if (!$memo)
        {
            return redirect()->route('memo.index');
        }

        return Inertia::render('Edit', ['memo' => $memo]);
    }

    public function update(MemoRequest $request)
    {
        $memoId = (int) $request->input('id');
        Memo::where('id', $memoId)->update([
            'title'  => $request->input('title'),
            'status' => $request->input('status'),
            'detail' => $request->input('detail'),
            'limit'  => $request->input('limit'),
        ]);

        return redirect()->route('memo.edit', ['id' => $memoId]);
    }
}
