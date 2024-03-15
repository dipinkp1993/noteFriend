<?php

use Livewire\Volt\Component;
use App\Models\Note;


new  class extends Component {
    public function with():array
    {
        return [
            'title'=>'Show Notes',
            'notes'=>Auth::user()
            ->notes()
            ->orderBy('send_date','DESC')
            ->get()
        ];
    }
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete',$note);
        $note->delete();
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">No notes yet</p>
                <p class="text-sm">Let's create your first note to send.</p>
                <x-button warning icon-right="plus" class="mt-6" href="{{route('note.create')}}" wire:navigate>Create
                    note</x-button>
            </div>
        @else
            <x-button class="mb-12" warning icon-right="plus" href="{{route('note.create')}}" wire:navigate>Create
                note</x-button>
            <div class="grid grid-cols-3 gap-4">
                @foreach ($notes as $note)
                    <x-card wire:key='{{ $note->id }}'>
                        <div class="flex justify-between">
                            <div>
                               
                                <p class="mt-2 text-xs">{{ Str::limit($note->body, 50) }}</p>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span></p>
                            <div>
                                <x-button.circle icon="eye"
                                    href="{{ route('notes.edit',$note) }}" wire:navigate></x-button.circle>
                                <x-button.circle icon="trash"
                                wire:click="delete('{{ $note->id }}')"></x-button.circle>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
