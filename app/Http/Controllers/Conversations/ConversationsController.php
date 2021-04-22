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

    public function index(Request $request)
    {
        $conversations = $request->user()->conversations;
        return view('conversations.index', compact('conversations'));
    }

    public function create(Request $request)
    {
        $conversations = $request->user()->conversations;

        return view('conversations.create', compact('conversations'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Conversation $conversation
     * @return Application|Factory|View
     */
    public function show(Conversation $conversation, Request $request)
    {
        $conversations = $request->user()->conversations;

        $request->user()->conversations()->updateExistingPivot($conversation, [
            'read_at' => now(),
        ]);
        return view('conversations.show', compact('conversation', 'conversations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Conversation $conversation
     * @return Response
     */
    public function edit(Conversation $conversation, Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Conversation $conversation
     * @return Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Conversation $conversation
     * @return Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
