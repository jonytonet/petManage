<?php

namespace App\Http\Livewire\Pet;

use Livewire\WithPagination;
use App\Models\Pet;
use Livewire\Component;

class TablePets extends Component
{
    use WithPagination;
    public $name = '';
    public $user_name = '';
    public $species = '';
    public $gender = '';
    public $date_of_birth = '';
    public $fur = '';
    public $size = '';
    public $microchip = '';
    public $search = '';
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $perPage = 25;

    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;

    public $editingPet = null;

    protected $rules = [
        'editingPet.name' => 'required|min:3',
        'editingPet.species' => 'required',
        'editingPet.gender' => 'required',
        'editingPet.date_of_birth' => 'required|date',
        'editingPet.fur' => 'required',
        'editingPet.size' => 'required',
        'editingPet.microchip' => 'required',
    ];

    public function render()
    {
        $pets = Pet::query()
            ->where('name', 'LIKE', '%'.$this->search.'%')
            ->orWhere('species', 'LIKE', '%'.$this->search.'%')
            ->orWhere('gender', 'LIKE', '%'.$this->search.'%')
            ->orWhere('fur', 'LIKE', '%'.$this->search.'%')
            ->orWhere('size', 'LIKE', '%'.$this->search.'%')
            ->orWhere('microchip', 'LIKE', '%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.pet.table-pets', compact('pets'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function create()
    {
        $this->showCreateModal = true;
    }

    public function save()
    {
        $this->validate();

        Pet::create($this->editingPet);

        $this->editingPet = null;
        $this->showCreateModal = false;
    }

    public function edit(Pet $pet)
    {
        $this->editingPet = $pet->toArray();
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate();

        Pet::findOrFail($this->editingPet['id'])->update($this->editingPet);

        $this->editingPet = null;
        $this->showEditModal = false;
    }

    public function delete(Pet $pet)
    {
        $this->editingPet = $pet->toArray();
        $this->showDeleteModal = true;
    }

    public function destroy()
    {
        Pet::findOrFail($this->editingPet['id'])->delete();

        $this->editingPet = null;
        $this->showDeleteModal = false;
    }



}
