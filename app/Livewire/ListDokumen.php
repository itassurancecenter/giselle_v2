<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Document;
use Livewire\WithPagination;

class ListDokumen extends Component
{
    use WithPagination;
    public $id_ticket;
    public $limitPerPage = '10';

    public function mount($id_ticket)
    {
        $this->id_ticket = $id_ticket;
    }

    public function render()
    {
        $document = Document::where('TicketID', $this->id_ticket)->paginate($this->limitPerPage);
        // dd($document);
        return view('livewire.list-dokumen', compact('document'));
    }
}
