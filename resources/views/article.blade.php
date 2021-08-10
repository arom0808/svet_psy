<x-app-layout>
    <section class="min-h-screen h-full bg-gray-100 bg-opacity-50 pt-5">
        <div class="container max-w-6xl mx-auto shadow-md md:w-3/4">
            <div class="space-y-6 bg-white p-6">
                <div class="w-full flex justify-center"><img src="{{ $article->previewPhotoUrlAttribute() }}" /></div>
                <div class="flex items-center">
                    <div class="block relative">
                        <img alt="profil" src="{{ $article->publisher->getProfilePhotoUrlAttribute() }}"
                            class="h-10 w-10 rounded-full object-cover" />
                    </div>
                    <div class="flex flex-col justify-between ml-4 text-sm">
                        <p class="text-gray-800 dark:text-white">
                            {{ $article->publisher->name }}
                        </p>
                        <p class="text-gray-400 dark:text-gray-300">
                            {{ $article->updated_at->diffForHumans() }} - {{ $article->time_to_read }} на чтение
                        </p>
                    </div>
                </div>
                <hr />
                <div class="text-5xl">{{ $article->title }}</div>
                <div class="leading-4">{{ $article->short_description }}<br>{{ $article->category }}</div>
                <hr />
                {!! $html !!}
            </div>
        </div>
    </section>
</x-app-layout>
