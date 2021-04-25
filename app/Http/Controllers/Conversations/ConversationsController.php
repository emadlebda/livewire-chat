<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConversationsController extends Controller
{

    public function index()
    {
        return view('conversations.index');
    }

    public function create()
    {
        return view('conversations.create');
    }

    /**
     * Display the specified resource.
     *
     * @param Conversation $conversation
     * @return Application|Factory|View
     */
    public function show(Conversation $conversation, Request $request)
    {
        $this->authorize('show', $conversation);

        $request->user()->conversations()->updateExistingPivot($conversation, ['read_at' => now(),]);

        return view('conversations.show', compact('conversation'));
    }
}
