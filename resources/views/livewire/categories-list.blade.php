<x-modal>
    <x-slot name="title">
        Выбор категорий
    </x-slot>

    <x-slot name="content">
        <div class="container flex flex-col w-full mx-auto items-center justify-center bg-white dark:bg-gray-800">
            <ul class="flex flex-col divide divide-y w-full">
                @foreach ($categories as $category)
                    @if(array_search($category->id,$selected)) <li class="flex flex-row w-full bg-gray-800 dark:bg-white">
                    @else <li class="flex flex-row w-full">  @endif
                        <div class="select-none cursor-pointer flex flex-1 items-center p-4" wire:click="$emit('selectCategory', {{$category->id}})" >
                            <div class="flex-1 pl-1 mr-16">
                                <div class="font-medium dark:text-white">
                                    {{$category->name}}
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </x-slot>
</x-modal>
