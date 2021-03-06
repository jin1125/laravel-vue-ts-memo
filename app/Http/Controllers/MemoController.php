<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use App\Models\Memo;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Services\GetMemoService;
use App\Services\CreateMemoService;
use App\Services\UpdateMemoService;
use App\Services\DestroyMemoService;

class MemoController extends Controller
{
    const FALSE_VALUE = 0;

    public function index(Request $request, GetMemoService $getMemoService)
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }

        $memos = $getMemoService->execute();

        $destroyMessage = $request->session()->get('destroyMessage') ?? '';

        return Inertia::render('Index', [
            'memos' => $memos,
            'destroyMessage' => $destroyMessage
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
        $userId = $memo->user_id ?? $this::FALSE_VALUE;
        $isOwnMemo = false;
        if ($userId) {
            $isOwnMemo = $userId === Auth::id();
        }

        if (!$isOwnMemo)
        {
            return redirect()->route('memo.index');
        }

        return Inertia::render('Edit', ['memo' => $memo]);
    }

    public function update(MemoRequest $request, UpdateMemoService $updateMemoService)
    {
        $memoId = $updateMemoService->execute($request);

        return redirect()->route('memo.edit', ['id' => $memoId]);
    }

    public function destroy(Request $request, DestroyMemoService $destroyMemoService)
    {
        $destroyMemoService->execute($request);

        $message = 'Delete successful';

        return redirect()->route('memo.index')->with('destroyMessage', $message);
    }
}
