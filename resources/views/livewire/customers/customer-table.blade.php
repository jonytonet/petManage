<div>
    <div class="flex justify-between mb-4">
        <div>
            <x-input id="search" wire:model="search" class="block w-full h-8" type="text" name="search"
                placeholder="Pesquisa" />

        </div>
        <livewire:customers.customer-create-modal>

    </div>
    <div class="overflow-x-scroll">
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2" wire:click="sortBy('id')">ID</th>
                    <th class="px-4 py-2" wire:click="sortBy('name')">Name</th>
                    <th class="px-4 py-2" wire:click="sortBy('email')">Email</th>
                    <th class="px-4 py-2" wire:click="sortBy('cellphone_number')">Celular</th>
                    <th class="px-4 py-2" wire:click="sortBy('phone_number')">Telefone</th>
                    <th class="px-4 py-2">#Pets</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>

                        <td class="px-4 py-2 text-sm border">{{ $customer->id }}</td>
                        <td class="px-4 py-2 text-sm border">{{ $customer->name }}</td>
                        <td class="px-4 py-2 text-sm border">{{ $customer->email }}</td>
                        <td class="px-4 py-2 text-sm border">{{ $customer->cellphone_number }}</td>
                        <td class="px-4 py-2 text-sm border">{{ $customer->phone_number }}</td>
                        <td class="px-4 py-2 text-sm border">{{ $customer->pets->count() }}</td>
                        <td class="flex items-center justify-start px-4 py-2 space-x-2 text-sm border">
                            <div>
                                <button wire:click="edit({{ $customer->id }})"
                                    class="px-2 py-1 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                            </div>
                            <div> &nbsp;</div>
                            <button wire:click="$emit('openModal', 'show', {{ $customer->id }})"
                                class="px-2 py-1 text-white rounded-md bg-violet-600 hover:bg-violet-700"><i
                                    class="fa-solid fa-binoculars"></i></button>
                            <div> &nbsp;</div>
                            <div>
                                <button wire:click="deleteConfirmModal( {{ $customer->id }})"
                                    class="bg-red-500 text-white  px-2 py-1  rounded-md hover:bg-red-600"><i
                                        class="fa-solid fa-trash"></i></button>
                            </div>

                            <div> &nbsp;</div>
                            <a href="{{ route('pet.management', ['customerId' => $customer->id]) }}"
                                class="px-2 py-1 text-white bg-yellow-700 rounded-md hover:bg-yellow-800"><i
                                    class="fa-solid fa-paw"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $customers->links() }}

    <div>

        <x-dialog-modal maxWidth="md" wire:model="showEditModal">
            <x-slot name="title">Editar Cliente</x-slot>
            <x-slot name="content">
                <form>
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block w-full mt-1 text-sm" type="text" name="name" required
                            wire:model.defer="name" />
                        @if ($errors->has('name'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div>
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block w-full mt-1 text-sm" type="email" name="email" required
                            wire:model.defer="email" />
                        @if ($errors->has('email'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="flex">
                        <div class="w-1/2 pr-2">
                            <x-label for="cpf" :value="__('CPF')" />
                            <x-input id="cpf" class="block w-full mt-1 text-sm" type="text" name="cpf"
                                data-mask="###.###.###-##" wire:model.defer="cpf" />
                            @if ($errors->has('cpf'))
                                <p class="mt-2 text-sm text-red-600">{{ $errors->first('cpf') }}</p>
                            @endif
                        </div>

                        <div class="w-1/2 pr-2">
                            <x-label for="rg" :value="__('RG')" />
                            <x-input id="rg" class="block w-full mt-1 text-sm" type="text" name="rg"
                                data-mask="##.###.###-#" wire:model.defer="rg" />
                            @if ($errors->has('rg'))
                                <p class="mt-2 text-sm text-red-600">{{ $errors->first('rg') }}</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <x-label for="gender" :value="__('Gênero')" />
                        <select id="gender"
                            class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            name="gender" wire:model.defer="gender">
                            <option value="">Selecione uma opção</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="N">Não informado</option>
                        </select>
                        @if ($errors->has('gender'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('gender') }}</p>
                        @endif
                    </div>

                    <div class="flex">
                        <div class="w-1/2 pr-2">
                            <x-label for="cellphone_number" :value="__('Celular')" />
                            <x-input id="cellphone_number" data-mask="(##)#####-####" class="block w-full mt-1 text-sm"
                                type="text" name="cellphone_number" wire:model.defer="cellphone_number" />
                            @if ($errors->has('cellphone_number'))
                                <p class="mt-2 text-sm text-red-600">{{ $errors->first('cellphone_number') }}</p>
                            @endif
                        </div>

                        <div class="w-1/2 pr-2">
                            <x-label for="phone_number" :value="__('Telefone')" />
                            <x-input id="phone_number" class="block w-full mt-1 text-sm" type="text"
                                name="phone_number" data-mask="(##)####-####" wire:model.defer="phone_number" />
                            @if ($errors->has('phone_number'))
                                <p class="mt-2 text-sm text-red-600">{{ $errors->first('phone_number') }}</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <x-label for="alternate_contact_name" :value="__('Contato Alternativo')" />
                        <x-input id="alternate_contact_name" class="block w-full mt-1 text-sm" type="text"
                            name="alternate_contact_name" wire:model.defer="alternate_contact_name" />

                    </div>

                    <div>
                        <x-label for="alternate_contact_cellphone_number" :value="__('Telefone Contato Alternativo')" />
                        <x-input id="alternate_contact_cellphone_number" class="block w-full mt-1 text-sm"
                            type="text" name="alternate_contact_cellphone_number" data-mask="(##)#####-####"
                            wire:model.defer="alternate_contact_cellphone_number" />

                    </div>
                    <div>
                        <x-label for="zip_code" :value="__('Cep')" />
                        <x-input id="zip_code" class="block w-full mt-1 text-sm" type="text" name="zip_code"
                            required data-mask="##.###-###" wire:model.defer="zip_code" wire:blur="getAddressInfo" />
                        @if ($errors->has('zip_code'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('zip_code') }}</p>
                        @endif

                    </div>
                    <div>
                        <x-label for="address" :value="__('Endereço')" />
                        <x-input id="address" class="block w-full mt-1 text-sm" type="text" name="address"
                            required wire:model.defer="address" />

                    </div>
                    <div class="flex">
                        <div class="w-1/2 pr-2">
                            <x-label for="number" :value="__('Número')" />
                            <x-input id="number" class="block w-full mt-1 text-sm" type="text" name="number"
                                required wire:model.defer="number" />

                        </div>
                        <div class="w-1/2 pl-2">
                            <x-label for="complement" :value="__('Complemento')" />
                            <x-input id="complement" class="block w-full mt-1 text-sm" type="text"
                                name="complement" wire:model.defer="complement" />

                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-1/2 pr-2">
                            <x-label for="district" :value="__('Bairro')" />
                            <x-input id="district" class="block w-full mt-1 text-sm" type="text" name="district"
                                required wire:model.defer="district" />
                        </div>
                        <div class="w-1/2 pl-2">
                            <x-label for="city" :value="__('Cidade')" />
                            <x-input id="city" class="block w-full mt-1 text-sm" type="text" name="city"
                                required wire:model.defer="city" />
                            @if ($errors->has('city'))
                                <p class="mt-2 text-sm text-red-600">{{ $errors->first('city') }}</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <x-label for="state" :value="__('Estado')" />
                        <x-input id="state" class="block w-full mt-1 text-sm" type="text" name="state"
                            required wire:model.defer="state" />

                    </div>
                    <div wire:loading
                        class="fixed top-0 left-0 z-50 flex items-center w-full h-full bg-gray-500 bg-opacity-75">
                        <div class="justify-center text-sm font-semibold tracking-widest text-black">
                            {{ $loadingMessage ?? 'Loading...' }}
                        </div>
                    </div>
                    @if (session()->has('error'))
                        <div id="alert-error"
                            class="flex justify-between p-4 mt-4 text-white bg-red-500 rounded alert-error"
                            role="alert">
                            <span>{{ session('error') }}</span>
                            <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif


                </form>
            </x-slot>
            <x-slot name="footer">
                <x-button wire:click="$set('showEditModal', false)">
                    {{ __('Fechar') }}
                </x-button>
                <x-button class="ml-2" wire:click="submitForm()">
                    {{ __('Salvar') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </div>

    <div>

        <x-dialog-modal maxWidth="sm" wire:model="showDeleteModal">
            <x-slot name="title">Excluir Cliente</x-slot>

            <div class="my-4 text-center">
                <x-slot name="content">
                    Tem certeza que deseja excluir este cliente,
                    {{ $name }}?
                </x-slot>
            </div>

            <x-slot name="footer">
                <x-button wire:click="closeDeleteModal()">
                    {{ __('Fechar') }}
                </x-button>
                <x-button class="ml-2 bg-red-500 hover:bg-red-600" wire:click="delete()">
                    {{ __('Excluir') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </div>



</div>
