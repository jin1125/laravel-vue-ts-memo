<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use App\Models\Memo;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    public function index(Request $request)
    {
        $memos = Memo::where('user_id', '=', Auth::id())
            ->orderBy('id', 'DESC')
            ->get();

        $successDestroy = $request->session()->get('successDestroy') ?? '';

        return Inertia::render('Index', [
            'memos' => $memos,
            'successDestroy' => $successDestroy
        ]);
    }

    public function create(MemoRequest $request)
    {
        Memo::create([
            'title'   => $request->input('title'),
            'status'  => $request->input('status'),
            'detail'  => $request->input('detail'),
            'limit'   => $request->input('limit'),
            'user_id' => Auth::id(),
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

        $message = 'Delete successful';
        return redirect()->route('memo.index')->with('successDestroy', $message);
    }
}
