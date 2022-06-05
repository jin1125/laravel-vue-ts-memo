<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $memo = Memo::where('id', $memoId)->firstOrFail();
        $memo->update([
            'title'  => $request->input('title'),
            'status' => $request->input('status'),
            'detail' => $request->input('detail'),
            'limit'  => $request->input('limit'),
        ]);

        return redirect()->route('memo.edit', ['id' => $memoId]);
    }

    public function destroy(Request $request)
    {
        $memoId = (int) $request->route('id');
        Memo::destroy($memoId);

        return redirect()->route('memo.index');
    }
}
