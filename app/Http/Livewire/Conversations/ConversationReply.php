<?php

namespace App\Http\Livewire\Conversations;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;
use Livewire\WithFileUploads;

class ConversationReply extends Component
{

    use WithFileUploads;

    public $body = '';
    public $attachment = '';
    public $attachmentName = '';
    public $conversation = '';

    protected $rules = [
        'body' => 'required',
        'attachment' => 'nullable|file|mimes:png,jpg,jpeg,gif,wav,mp3,mp4|max:102400',
    ];

    public function mount(Conversation $conversation)
    {
        $this->$conversation = $conversation;
    }

    public function render()
    {
        return view('livewire.conversations.conversation-reply');
    }


    public function reply()
    {
        $this->validate();

        if (!is_null($this->attachment)) {
            $this->attachmentName = md5($this->attachment . microtime()) . '.' . $this->attachment->extension();
            $this->attachment->storeAs('/', $this->attachmentName, 'media');
            $data['attachment'] = $this->attachmentName;
        }

        $data['body'] = $this->body;
        $data['user_id'] = auth()->id();

        $message = $this->conversation->messages()->create($data);
        $this->conversation->update(['last_message_at' => now()]);

        foreach ($this->conversation->others as $user) {
            $user->conversations()->updateExistingPivot($this->conversation, [
                'read_at' => null,
            ]);
        }

        $this->body = '';
        $this->attachment = '';
        $this->attachmentName = '';
    }
}
