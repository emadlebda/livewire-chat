<?php

namespace App\Http\Livewire\Conversations;

use App\Events\Conversations\ConversationCreated;
use App\Models\Conversation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Str;

class ConversationCreate extends Component
{
    public $name = '';
    public $body = '';
    public $users = [];


    protected $rules = [
        'users' => 'required',
        'name' => 'nullable|string',
        'body' => 'required',
    ];

    public function addUser($user)
    {
        $this->users[] = $user;
    }

    public function create()
    {
        $this->validate();

        $conversation = Conversation::create([
            'name' => $this->name,
            'uuid' => Str::uuid(),
            'user_id' => auth()->id(),
        ]);

        $conversation->messages()->create([
            'user_id' => auth()->id(),
            'body' => $this->body
        ]);

        $conversation->users()->sync($this->collectUsersIds());

        broadcast(new ConversationCreated($conversation))->toOthers();

        return redirect()->route('conversations.show', $conversation);

    }

    /**
     * get conversation's users id
     * @return Collection
     */
    public function collectUsersIds(): Collection
    {
        return collect($this->users)->merge([auth()->user()])
            ->pluck('id')
            ->unique();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('livewire.conversations.conversation-create');
    }
}
