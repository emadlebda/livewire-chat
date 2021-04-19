<?php

namespace App\Http\Livewire\Conversations;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Collection;
use Livewire\Component;

class ConversationMessages extends Component
{

    public $conversationId = '';
    public $messages;

    /**
     * @return array
     */
    public function getListeners(): array
    {
        return [
            'message.created' => 'prependMessage',
            "echo-private:conversations.{$this->conversationId},Conversations\\MessageAdded" => 'prependMessageFromBroadcast',
        ];
    }

    public function mount(Conversation $conversation, Collection $messages)
    {
        $this->conversationId = $conversation->id;
        $this->$messages = $messages;
    }

    public function render()
    {
        return view('livewire.conversations.conversation-messages');
    }


    public function prependMessage($id)
    {
        $this->messages->push(Message::find($id));
    }

    public function prependMessageFromBroadcast($payload)
    {
        $this->prependMessage($payload['message']['id']);
    }
}
