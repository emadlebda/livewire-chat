<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{

    public function index(Request $request)
    {
        $conversations = $request->user()->conversations;
        return view('conversations.index', compact('conversations'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Conversation $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation, Request $request)
    {
        $conversations = $request->user()->conversations;
        return view('conversations.show', compact('conversation','conversations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Conversation $conversation
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Conversation $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
