<div>

    @foreach($messages as $message)
        @if($message->isOwner())
            <livewire:conversations.conversation-message-owner :message="$message" :key="$message->id"/>
        @else
            <livewire:conversations.conversation-message :message="$message" :key="$message->id"/>
        @endif
    @endforeach


</div>
