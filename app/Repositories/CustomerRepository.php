<?php

namespace App\Repositories;

use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Fluent;

class CustomerRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getById($id)
    {
        return $this->user->where('user_type_id', UserTypeEnum::CUSTOMER)->where('id', $id)->first();
    }

    public function getByEmailOrName($emailOrName)
    {
        return $this->user->where('user_type_id', UserTypeEnum::CUSTOMER)
            ->where(function ($query) use ($emailOrName) {
                $query->where('email', $emailOrName)
                    ->orWhere('name', 'like', '%'.$emailOrName.'%');
            })
            ->get();
    }

    public function getAll()
    {
        return $this->user->where('user_type_id', UserTypeEnum::CUSTOMER)->get();
    }

    public function save(array $data): string
    {
        return $this->user->insertGetId($data);
    }

    public function saveCostumerAddress(array $data): UserAddress
    {
        return UserAddress::create($data);
    }

    public function update(string $id, array $data): User
    {
        $user = $this->getById($id);
        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->getById($id);

        return $user->delete();
    }

    public function searchCustomers(string $search = null, string $orderBy = 'name', string $orderDirection = 'asc', int $perPage = 25): LengthAwarePaginator
    {
        $query = $this->user->newQuery()
            ->withCount('pets')
            ->where('user_type_id', '=', UserTypeEnum::CUSTOMER);

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%')
                    ->orWhere('id', 'LIKE', '%'.$search.'%');
            });
        }

        return $query->orderBy($orderBy, $orderDirection)->paginate($perPage);
    }

    public function getAdressInfo(string $zipcode)
    {
        $response = Http::get("https://viacep.com.br/ws/$zipcode/json/");

        if ($response->ok()) {
            return $response->json();
        }

        return new Fluent(['status' => 'error', 'message' => $response->json()->message]);
    }

    public function updateCostumerAddress(int $user_id, array $address)
    {
        return UserAddress::where('user_id', $user_id)->update($address);
    }
}
