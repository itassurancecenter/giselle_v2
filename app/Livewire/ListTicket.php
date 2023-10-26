<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithPagination;
use App\Models\Ticket;

class ListTicket extends Component
{
    use WithPagination;
    public $limitPerPage = '10';
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $ticket = Ticket::paginate($this->limitPerPage);
        // dd($jml_dokumen);
        return view('livewire.list-ticket', compact('ticket'));
    }
}
