<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-12">
    @foreach ($articles as $article)
        <div class="overflow-hidden shadow-lg rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
            <a href="{{ route('article', $article->id) }}" class="w-full block h-full">
                <img alt="blog photo" src="{{ $article->preview_photo_path }}" class="max-h-40 w-full object-cover" />
                <div class="bg-white dark:bg-gray-800 w-full p-4">
                    <p class="text-indigo-500 text-md font-medium">{{ $article->category }}</p>
                    <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">{{ $article->title }}</p>
                    <p class="text-gray-400 dark:text-gray-300 font-light text-md">
                        {{ $article->short_description }}
                    </p>
                    <div class="flex items-center mt-4">
                        <div class="block relative">
                            <img alt="profil" src="{{ $article->publisher->profile_photo_url }}"
                                class="mx-auto object-cover rounded-full h-10 w-10 " />
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
<script type="text/javascript">
    is_loading = false;
    window.livewire.on('userStore', function() {
        is_loading = false;
    });
    window.onscroll = function(ev) {
        if ((is_loading === false) && ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight)) {
            is_loading = true;
            window.livewire.emit('load-more');
        }
    }
</script>
