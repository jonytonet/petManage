<div>


    <x-button class=" h-8" wire:click="create">
        {{ __('Cadastrar Cliente') }}
    </x-button>
    <x-dialog-modal maxWidth="md" wire:model="showCreateModal">
        <x-slot name="title">Cadastrar Cliente</x-slot>
        <x-slot name="content">
            <form>
                <div>
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full text-sm" type="text" name="name" required
                        wire:model.defer="name" />
                    @if ($errors->has('name'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div>
                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block mt-1 w-full text-sm" type="email" name="email" required
                        wire:model.defer="email" />
                    @if ($errors->has('email'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="flex">
                    <div class="w-1/2 pr-2">
                        <x-label for="cpf" :value="__('CPF')" />
                        <x-input id="cpf" class="block mt-1 w-full text-sm" type="text" name="cpf"
                            data-mask="###.###.###-##" wire:model.defer="cpf" />
                        @if ($errors->has('cpf'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('cpf') }}</p>
                        @endif
                    </div>

                    <div class="w-1/2 pr-2">
                        <x-label for="rg" :value="__('RG')" />
                        <x-input id="rg" class="block mt-1 w-full text-sm" type="text" name="rg"
                            data-mask="##.###.###-#" wire:model.defer="rg" />
                        @if ($errors->has('rg'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('rg') }}</p>
                        @endif
                    </div>
                </div>
                <div>
                    <x-label for="gender" :value="__('Gênero')" />
                    <select id="gender"
                        class="block mt-1 w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
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
                        <x-input id="cellphone_number" data-mask="(##)#####-####" class="block mt-1 w-full text-sm"
                            type="text" name="cellphone_number" wire:model.defer="cellphone_number" />
                        @if ($errors->has('cellphone_number'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('cellphone_number') }}</p>
                        @endif
                    </div>

                    <div class="w-1/2 pr-2">
                        <x-label for="phone_number" :value="__('Telefone')" />
                        <x-input id="phone_number" class="block mt-1 w-full text-sm" type="text" name="phone_number"
                            data-mask="(##)####-####" wire:model.defer="phone_number" />
                        @if ($errors->has('phone_number'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('phone_number') }}</p>
                        @endif
                    </div>
                </div>

                <div>
                    <x-label for="alternate_contact_name" :value="__('Contato Alternativo')" />
                    <x-input id="alternate_contact_name" class="block mt-1 w-full text-sm" type="text"
                        name="alternate_contact_name" wire:model.defer="alternate_contact_name" />

                </div>

                <div>
                    <x-label for="alternate_contact_cellphone_number" :value="__('Telefone Contato Alternativo')" />
                    <x-input id="alternate_contact_cellphone_number" class="block mt-1 w-full text-sm" type="text"
                        name="alternate_contact_cellphone_number" data-mask="(##)#####-####"
                        wire:model.defer="alternate_contact_cellphone_number" />

                </div>
                <div>
                    <x-label for="zip_code" :value="__('Cep')" />
                    <x-input id="zip_code" class="block mt-1 w-full text-sm" type="text" name="zip_code" required
                        data-mask="##.###-###" wire:model.defer="zip_code" wire:blur="getAddressInfo" />
                    @if ($errors->has('zip_code'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('zip_code') }}</p>
                    @endif

                </div>
                <div>
                    <x-label for="address" :value="__('Endereço')" />
                    <x-input id="address" class="block mt-1 w-full text-sm" type="text" name="address" required
                        wire:model.defer="address" />

                </div>
                <div class="flex">
                    <div class="w-1/2 pr-2">
                        <x-label for="number" :value="__('Número')" />
                        <x-input id="number" class="block mt-1 w-full text-sm" type="text" name="number" required
                            wire:model.defer="number" />

                    </div>
                    <div class="w-1/2 pl-2">
                        <x-label for="complement" :value="__('Complemento')" />
                        <x-input id="complement" class="block mt-1 w-full text-sm" type="text" name="complement"
                            wire:model.defer="complement" />

                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/2 pr-2">
                        <x-label for="district" :value="__('Bairro')" />
                        <x-input id="district" class="block mt-1 w-full text-sm" type="text" name="district"
                            required wire:model.defer="district" />
                    </div>
                    <div class="w-1/2 pl-2">
                        <x-label for="city" :value="__('Cidade')" />
                        <x-input id="city" class="block mt-1 w-full text-sm" type="text" name="city"
                            required wire:model.defer="city" />
                        @if ($errors->has('city'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('city') }}</p>
                        @endif
                    </div>
                </div>
                <div>
                    <x-label for="state" :value="__('Estado')" />
                    <x-input id="state" class="block mt-1 w-full text-sm" type="text" name="state" required
                        wire:model.defer="state" />

                </div>
                <div wire:loading
                    class="fixed top-0 left-0 w-full h-full bg-gray-500 bg-opacity-75 flex items-center  z-50">
                    <div class="text-black text-sm font-semibold tracking-widest justify-center">
                        {{ $loadingMessage ?? 'Loading...' }}
                    </div>
                </div>

                @if (session()->has('error'))
                    <div class="alert-error bg-red-500 text-white p-4 flex justify-between mt-4 rounded"
                        role="alert">
                        <span> {{ session('error') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="$set('showCreateModal', false)">
                {{ __('Fechar') }}
            </x-button>
            <x-button class="ml-2" wire:click="submitForm()">
                {{ __('Salvar') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
