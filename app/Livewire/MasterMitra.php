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
    public $search = '';
    public $limitPerPage = '10';

    public function render()
    {
        $data_mitra = Partner::orderBy('id_partner', 'asc')->paginate($this->limitPerPage);

        if($this->search !== NULL){
            $data_mitra = Partner::where('partner_name','like', '%' . $this->search . '%')->paginate($this->limitPerPage);
        }
        // $this->emit('postStore');

        return view('livewire.master-mitra', compact('data_mitra'));
    }
}
