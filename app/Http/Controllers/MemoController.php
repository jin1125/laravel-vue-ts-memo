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
        Memo::create([
            'title'  => $request->input('title'),
            'detail' => $request->input('detail'),
            'limit'  => $request->input('limit'),
        ]);

        return redirect()->route('dashboard');
    }
}
