<?php

namespace App\Http\Livewire\Conversations;

use Livewire\Component;

class ConversationMessages extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.conversations.conversation-messages');
    }
}
