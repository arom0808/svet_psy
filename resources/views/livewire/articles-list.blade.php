<div class="w-full bg-white p-12">
    <div class="bg-white header flex justify-center m-12 flex-col items-center sm:flex-row sm:justify-between">
        <p class="title text-4xl font-bold text-gray-800 mb-4"> Последние статьи </p>
        <div class="text-end">
            {{-- <form class="flex w-full max-w-sm space-x-3"> --}}
                <div class=" relative ">
                    <input wire:change="search($event.target.value)" onchange="this.blur(); history.pushState(null, null, '/articles/search/'+this.value);" type="text" id="&quot;form-subscribe-Search"
                        class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                        value="{{$searchExpression}}" placeholder="Search" />
                </div>
                {{-- <button
                    class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200"
                    type="submit">
                    Search
                </button> --}}
            {{-- </form> --}}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-12">
        @foreach($articles as $article)
            <div class="overflow-hidden shadow-lg rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
                <a href="" class="w-full block h-full">
                    <img alt="blog photo" src="{{ $article->preview_photo_path }}" class="max-h-40 w-full object-cover" />
                        <div class="bg-white dark:bg-gray-800 w-full p-4">
                        <p class="text-indigo-500 text-md font-medium">{{ $article->category }}</p>
                        <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">{{ $article->title }}</p>
                        <p class="text-gray-400 dark:text-gray-300 font-light text-md">
                            {{ $article->short_description }}
                        </p>
                        <div class="flex items-center mt-4">
                            <div class="block relative">
                                <img alt="profil" src="{{ $article->publisher->profile_photo_url }}" class="mx-auto object-cover rounded-full h-10 w-10 " />
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
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
