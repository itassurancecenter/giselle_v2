<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Partner;
use App\Models\User;

class MasterMitra extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $limitPerPage = '10';
    public $search = '';

    public function render()
    {
        $data_mitra = Partner::where('partner_name', 'LIKE', '%'.$this->search.'%')->orderBy('id_partner', 'asc')->paginate($this->limitPerPage);

        return view('livewire.master-mitra', compact('data_mitra'));
    }
}
