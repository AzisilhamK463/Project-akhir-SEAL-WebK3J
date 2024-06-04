<x-app-layout>
    @slot('title')
        {{ __('Modul') }}
    @endslot

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modul') }}
        </h2>
    </x-slot>

    <x-container class="p-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-3 py-3">
            @auth
                <a href="{{ route('modul.create') }}">
                    <x-primary-button class="mb-6">
                        {{ __('Create a Modul') }}
                    </x-primary-button>
                </a>
            @endauth
            <div class="text-gray-900 dark:text-gray-100 mb-3">
                {{ __('Modules :') }}
            </div>
            <div class="grid grid-cols-4 gap-4">
                @foreach ($modul as $item)
                    <x-card class="w-full">
                        <x-card.header>
                            <x-card.title>
                                {{ $item->name }}
                            </x-card.title>
                            <x-card.file-type>
                                {{ $item->file_type }}
                            </x-card.file-type>
                            <x-card.description>
                                {{ $item->description }}
                            </x-card.description>
                            @auth
                                @if ($item->user_id === auth()->user()->id)
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('modul.edit', $item) }}" class="text-sm underline text-blue-500">
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('modul.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus modul ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-sm underline text-red-500">{{ __('Delete') }}</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </x-card.header>
                        <x-card.content>
                            <x-preview :item="$item" />
                        </x-card.content>
                    </x-card>
                @endforeach
            </div>
        </div>
    </x-container>
</x-app-layout>

