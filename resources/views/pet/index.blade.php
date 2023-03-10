<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciador de Pets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6" id='content-body'>
                    @if (session()->has('success'))
                        <div id="alert-success"
                            class="alert-success bg-green-500 text-white p-4 flex justify-between mb-4 rounded"
                            role="alert">
                            <span>{{ session('success') }}</span>
                            <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div id="alert-error"
                            class="alert-error bg-red-500 text-white p-4 flex justify-between mb-4 rounded"
                            role="alert">
                            <span>{{ session('error') }}</span>
                            <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @livewire('pet.table-pets')


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
