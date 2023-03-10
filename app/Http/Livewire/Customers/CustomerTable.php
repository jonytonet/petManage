<?php

namespace App\Http\Livewire\Customers;

use Illuminate\Support\Str;
use App\Services\CustomerService;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTable extends Component
{
    use WithPagination;
    public $customer_id;
    public $name;
    public $email;
    public $cpf;
    public $rg;
    public $gender;
    public $cellphone_number;
    public $phone_number;
    public $alternate_contact_name;
    public $alternate_contact_cellphone_number;
    public $zip_code;
    public $address;
    public $number;
    public $complement;
    public $district;
    public $city;
    public $state;
    public $loadingMessage = 'Loading...';
    public $search = '';
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $editingCustomer = null;
    public $perPage = 25;



    public function render(CustomerService $customerService)
    {

        $customers = $customerService->searchCustomers($this->search, $this->sortBy, $this->sortDirection, $this->perPage);

        return view('livewire.customers.customer-table', compact('customers'));
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
    public function edit($id)
    {
        $this->customer_id = $id;
        $this->mountForm();
        $this->showEditModal = true;
    }

    public function mountForm()
    {
        $user = app()->make(CustomerService::class)->getById($this->customer_id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->cpf = $user->cpf;
        $this->rg = $user->rg;
        $this->gender = $user->gender;
        $this->cellphone_number = $user->cellphone_number;
        $this->phone_number = $user->phone_number;
        $this->alternate_contact_name = $user->alternate_contact_name;
        $this->alternate_contact_cellphone_number = $user->alternate_contact_cellphone_number;
        $address = $user->address;
        $this->zip_code = $address->zip_code;
        $this->address = $address->address;
        $this->number = $address->number;
        $this->complement = $address->complement;
        $this->district = $address->district;
        $this->city = $address->city;
        $this->state = $address->state;
    }

    public function submitForm(CustomerService $customerService)
    {
        $user = [
            'name' => Str::title($this->name),
            'email' => $this->email,
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'gender' => $this->gender,
            'cellphone_number' => $this->cellphone_number,
            'phone_number' => $this->phone_number,
            'alternate_contact_name' => $this->alternate_contact_name,
            'alternate_contact_cellphone_number' => $this->alternate_contact_cellphone_number,

        ];
        $address = [
            'zip_code' => $this->zip_code,
            'address' => $this->address,
            'number' => $this->number,
            'complement' => $this->complement,
            'district' => $this->district,
            'city' => $this->city,
            'state' => $this->state,
        ];
        $update = $customerService->update($this->customer_id, $user, $address);
        if ($update->status == 'error') {
            session()->flash('error', $update->message);
        } else {
            $this->showEditModal = false;
            $this->name = '';
            $this->email = '';
            $this->cpf = '';
            $this->rg = '';
            $this->gender = '';
            $this->cellphone_number = '';
            $this->phone_number = '';
            $this->alternate_contact_name = '';
            $this->alternate_contact_cellphone_number = '';
            $this->zip_code = '';
            $this->address = '';
            $this->number = '';
            $this->complement = '';
            $this->district = '';
            $this->city = '';
            $this->state = '';
            session()->flash('success', $update->message);

        }
    }

    public function deleteConfirmModal($id)
    {
        $user = app()->make(CustomerService::class)->getById($id);
        $this->customer_id = $id;
        $this->name = $user->name;
        $this->showDeleteModal = true;
    }

    public function delete(CustomerService $customerService)
    {
        $deleted = $customerService->delete($this->customer_id);

        if ($deleted->status == 'error') {
            $this->showDeleteModal = false;
            session()->flash('error', $deleted->message);
            $this->flash('success', $deleted->message, [], '/customers-management');
        } else {
            session()->flash('success', $deleted->message);
            $this->flash('success', $deleted->message, [], '/customers-management');
            $this->closeDeleteModal();
        }
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
    }



}
