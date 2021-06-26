<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @forelse($quotes as $quote)
        <div class="w-full flex flex-col md:flex-row gap-4 mb-8 md:mb-0 flex-between items-center p-8">
            <div class="bg-white dark:bg-gray-800 w-72 shadow-lg mx-auto rounded-xl p-4">
                <p class="text-gray-600 dark:text-white">
            <span class="font-bold text-indigo-500 text-lg">
                “
            </span>
                    To get social media testimonials like these, keep your customers engaged with your social media
                    accounts by posting regularly yourself
                    <span class="font-bold text-indigo-500 text-lg">
                ”
            </span>
                </p>
                <div class="flex items-center mt-4">
                    <a href="#" class="block relative">
                        <img alt="profil" src="/images/person/1.jpg"
                             class="mx-auto object-cover rounded-full h-10 w-10 "/>
                    </a>
                    <div class="flex flex-col ml-2 justify-between">
                <span class="font-semibold text-indigo-500 text-sm">
                    Jean Miguel
                </span>
                        <span class="dark:text-gray-400 text-xs flex items-center">
                    User of Tail-Kit
                </span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>Ничего нету</p>
    @endforelse
    <button type="button" class="" wire:click="load()">load</button>
</div>
