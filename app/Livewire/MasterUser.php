<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class MasterUser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $limitPerPage = '10';

    public function render()
    {
        $data_user = User::whereNot('username', 'LIKE', 'user_%')->paginate($this->limitPerPage);
        return view('livewire.master-user', compact('data_user'));
    }
}
