<?php

namespace App\Services;

use App\Models\Memo;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class DestroyMemoService
{
    public function execute($request)
    {
        $memoId = (int) $request->route('id');
        $memo = Memo::where('id', $memoId)->firstOrFail();
        $isOwnMemo = $memo->user_id === Auth::id();
        if (!$isOwnMemo)
        {
            throw new AccessDeniedException();
        }

        Memo::destroy($memoId);
    }
}