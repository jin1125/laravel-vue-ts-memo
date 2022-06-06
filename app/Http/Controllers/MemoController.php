<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use App\Models\Memo;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use App\Services\GetMemoService;
use App\Services\CreateMemoService;

class MemoController extends Controller
{
    public function index(Request $request, GetMemoService $getMemoService)
    {
        $memos = $getMemoService->execute();

        $successDestroy = $request->session()->get('successDestroy') ?? '';

        return Inertia::render('Index', [
            'memos' => $memos,
            'successDestroy' => $successDestroy
        ]);
    }

    public function create(MemoRequest $request, CreateMemoService $createMemoService)
    {
        $createMemoService->execute($request);

        return redirect()->route('memo.index');
    }

    public function edit($id)
    {
        $memo = Memo::find($id);
        $isOwnMemo = $memo->user_id === Auth::id();

        if (!$memo || !$isOwnMemo)
        {
            return redirect()->route('memo.index');
        }

        return Inertia::render('Edit', ['memo' => $memo]);
    }

    public function update(MemoRequest $request)
    {
        $memoId = (int) $request->route('id');
        $memo = Memo::where('id', $memoId)->firstOrFail();
        $isOwnMemo = $memo->user_id === Auth::id();
        if (!$isOwnMemo)
        {
            throw new AccessDeniedException();
        }

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
        $memo = Memo::where('id', $memoId)->firstOrFail();
        $isOwnMemo = $memo->user_id === Auth::id();
        if (!$isOwnMemo)
        {
            throw new AccessDeniedException();
        }

        Memo::destroy($memoId);

        $message = 'Delete successful';
        return redirect()->route('memo.index')->with('successDestroy', $message);
    }
}
