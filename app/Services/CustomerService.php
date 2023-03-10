<?php

namespace App\Services;

use App\Enums\UserTypeEnum;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getById($id)
    {
        return $this->customerRepository->getById($id);
    }

    public function getByEmailOrName($emailOrName)
    {
        return $this->customerRepository->getByEmailOrName($emailOrName);
    }

    public function getAll()
    {
        return $this->customerRepository->getAll();
    }

    public function save(array $user, array $address)
    {
        $password = Str::random(8);
        $user['password'] = $password;
        //enviar email
        $user = $this->prepareData($user);
        $user_id = $this->customerRepository->save($user);
        if (! $user_id) {
            return new Fluent(['status' => 'error', 'message' => 'Houve um erro ao tentar cadastrar o cliente.']);
        }
        $address['zip_code'] = preg_replace('/\D/', '', $address['zip_code']);
        $address['user_id'] = $user_id;
        $user_address = $this->customerRepository->saveCostumerAddress($address);
        if (! $user_address) {
            $this->customerRepository->delete($user_id);

            return new Fluent(['status' => 'error', 'message' => 'Houve um erro ao tentar cadastrar o cliente.']);
        }

        return new Fluent(['status' => 'success', 'data' => $user_id, 'message' => 'Cliente cadastrado com sucesso!']);
    }

    public function update($id, $data, $address)
    {
        $data = $this->prepareData($data);
        $address['zip_code'] = preg_replace('/\D/', '', $address['zip_code']);
        $user = $this->customerRepository->update($id, $data);

        if (! $user) {
            return new Fluent(['status' => 'error', 'message' => 'Houve um erro ao tentar atualizar o cliente.']);
        }
        $user_address = $this->customerRepository->updateCostumerAddress($id, $address);
        if (! $user_address) {
            return new Fluent(['status' => 'error', 'message' => 'Houve um erro ao tentar atualizar o cliente.']);
        }

        return new Fluent(['status' => 'success', 'message' => 'Cliente atualizado com sucesso!']);
    }

    public function delete($id)
    {
        $deleted = $this->customerRepository->delete($id);

        if (! $deleted) {
            return new Fluent(['status' => 'error', 'message' => 'Houve um erro ao tentar excluir o cliente.']);
        }

        return new Fluent(['status' => 'success', 'message' => 'Cliente excluido com sucesso!']);
    }

    protected function prepareData($data)
    {
        $data['user_type_id'] = UserTypeEnum::CUSTOMER; // set customer user type
        $data['cpf'] = preg_replace('/\D/', '', $data['cpf']); // remove non-digits from cpf
        $data['rg'] = preg_replace('/\D/', '', $data['rg']); // remove non-digits from rg
        $data['cellphone_number'] = preg_replace('/\D/', '', $data['cellphone_number']); // remove non-digits from cellphone number
        $data['phone_number'] = preg_replace('/\D/', '', $data['phone_number']); // remove non-digits from phone number
        $data['alternate_contact_cellphone_number'] = preg_replace('/\D/', '', $data['alternate_contact_cellphone_number']); // remove non-digits from alternate contact cellphone number

        return $data;
    }

    public function searchCustomers(string $search, string $orderBy, string $orderDirection, int $perPage)
    {
        $customers = $this->customerRepository->searchCustomers($search, $orderBy, $orderDirection, $perPage);

        return $customers;
    }

    public function getAdressInfo(string $zipcode)
    {
        $zipcode = preg_replace('/\D/', '', $zipcode); // remove non-digits from c

        return $this->customerRepository->getAdressInfo($zipcode);
    }
}
