<?php

namespace App\Http\Livewire\Customers;

use App\Services\CustomerService;
use Illuminate\Support\Str;

use Livewire\Component;

class CustomerCreateModal extends Component
{


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

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
    ];

    public function submitForm(CustomerService $customerService)
    {
        $this->validate();

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
        $customer = $customerService->save($user, $address);
        if ($customer->status == 'error') {
            session()->flash('error', $customer->message);
        } else {
            $this->showCreateModal = false;
            // Limpa os campos do formulário após o envio dos dados
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
            session()->flash('success', $customer->message);

        }
    }

    public $showCreateModal = false;

    public function render()
    {
        return view('livewire.customers.customer-create-modal');
    }

    public function create()
    {
        $this->showCreateModal = true;
    }

    public function getAddressInfo(CustomerService $customerService)
    {
        if (strlen($this->zip_code) == 0) {
            $this->address = '';
            $this->number = '';
            $this->complement = '';
            $this->district = '';
            $this->city = '';
            $this->state = '';

            return;
        }
        $this->loadingMessage = 'Buscando endereço...';
        $response = $customerService->getAdressInfo($this->zip_code);

        if (isset($response['erro'])) {
            $this->addError('zip_code', 'CEP inválido.');
        } else {
            $this->address = $response['logradouro'];
            $this->district = $response['bairro'];
            $this->city = $response['localidade'];
            $this->state = $response['uf'];
        }
    }
}
