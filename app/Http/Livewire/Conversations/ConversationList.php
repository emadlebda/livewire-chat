<?php

namespace App\Http\Livewire\Conversations;

use App\Models\Conversation;
use Illuminate\Support\Collection;
use Livewire\Component;

class ConversationList extends Component
{
    public $conversations;


    /**
     * @return array
     */
    public function getListeners(): array
    {
        return [
//            'echo-private:User.' . auth()->id() . ',Conversations\\ConversationCreated' => 'createConversationFromBroadcast',
            'echo-private:User.' . auth()->id() . ',Conversations\\ConversationUpdated' => 'updateConversationFromBroadcast'
        ];
    }


    public function mount(Collection $conversations)
    {
        $this->conversations = $conversations;
    }

    public function render()
    {
        return view('livewire.conversations.conversation-list');
    }


//    public function createConversationFromBroadcast($payload)
//    {
//        return $this->conversations->prepend(Conversation::find($payload['conversation']['id']));
//    }

    public function updateConversationFromBroadcast($payload)
    {
        if (!$this->conversations->contains($payload['conversation']['id'])) {
            $this->conversations->prepend(Conversation::find($payload['conversation']['id']));
        } else {
            $this->conversations->find($payload['conversation']['id'])->fresh();
        }

    }
}
