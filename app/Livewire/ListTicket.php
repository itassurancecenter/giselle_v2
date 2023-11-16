<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithPagination;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;

class ListTicket extends Component
{
    use WithPagination;
    public $limitPerPage = '10';
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $currentRoute = Route::currentRouteName();
        // dd($currentRoute);
        if($currentRoute == 'list.sirkulir'){
            $ticket = Ticket::whereHas('sirkulir')->paginate($this->limitPerPage);
        }elseif($currentRoute == 'list-done'){
            $ticket = Ticket::whereHas('documentDone')->paginate($this->limitPerPage);
        }elseif($currentRoute == 'list-done-signed'){
            $ticket = Ticket::whereHas('doneSigned')->paginate($this->limitPerPage);
        }

        return view('livewire.list-ticket', compact('ticket'));
    }
}
