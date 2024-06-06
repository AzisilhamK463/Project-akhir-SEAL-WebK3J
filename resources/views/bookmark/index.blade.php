<x-app-layout>
    @slot('title')
        {{ __('My Bookmarks') }}
    @endslot

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Bookmarks') }}
        </h2>
    </x-slot>

    <x-container class="p-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg px-3 py-3">
            <div class="text-gray-900 dark:text-gray-100 mb-3">
                {{ __('Modules :') }}
            </div>
            <div class="grid grid-cols-5 gap-5 py-4">
                @foreach ($bookmarks as $item)
                    <x-card class="w-full">
                        <x-card.header>
                            <x-card.title>
                                {{ $item->modul->name }}
                            </x-card.title>
                            <x-card.filename>
                                {{ $item->modul->file_name }}
                            </x-card.filename>
                            <x-card.file-type>
                                {{ $item->modul->file_type }}
                            </x-card.file-type>
                            <x-card.description>
                                {{ $item->modul->description }}
                            </x-card.description>
                            <div class="flex items-center space-x-2 gap-x-6">
                                <a href="{{ route('modul.download', $item->modul) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 stroke-green-700">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                </a>
                                @auth
                                    @if (auth()->user()->bookmarks->contains('modul_id', $item->modul_id))
                                        <form action="{{ route('bookmark.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="modul_id" value="{{ $item->modul_id }}">
                                            <button type="submit" class="pt-1"><svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-5 stroke-orange-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m3 3 1.664 1.664M21 21l-1.5-1.5m-5.485-1.242L12 17.25 4.5 21V8.742m.164-4.078a2.15 2.15 0 0 1 1.743-1.342 48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185V19.5M4.664 4.664 19.5 19.5" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('bookmark.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="modul_id" value="{{ $item->modul_id }}">
                                            <button type="submit" class="pt-1"><svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-5 stroke-yellow-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    @if ($item->modul->user_id === auth()->user()->id)
                                        <a href="{{ route('modul.edit', $item->modul) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5 stroke-cyan-500">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('modul.destroy', $item->modul) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus modul ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="pt-1"><svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-5 stroke-red-700">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </x-card.header>
                        <x-card.content>
                            <x-preview :item="$item->modul" />
                        </x-card.content>
                    </x-card>
                @endforeach
            </div>
        </div>
    </x-container>
</x-app-layout>
