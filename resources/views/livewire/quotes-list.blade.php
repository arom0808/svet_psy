<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
    @foreach ($quotes as $quote)
        <div class="flex flex-col md:flex-row gap-4 flex-between items-center p-8 m-4">
            <div class="bg-white dark:bg-gray-800 w-72 shadow-lg mx-auto rounded-xl p-4">
                <p class="text-gray-600 dark:text-white break-words">
                    <span class="font-bold text-indigo-500 text-lg">“</span>{{ $quote->text }}<span
                        class="font-bold text-indigo-500 text-lg">”</span>
                </p>
                <div class="flex items-center mt-4">
                    <div class="block relative">
                        <img alt="profile" src="{{ $quote->publisher->getProfilePhotoUrlAttribute() }}"
                            class="mx-auto object-cover rounded-full h-10 w-10 " />
                    </div>
                    <div class="flex flex-col ml-2 justify-between">
                        <span class="dark:text-gray-400 text-xs italic flex items-center">
                            {{ $quote->author }}
                        </span>
                        <span class="font-semibold text-indigo-500 text-sm">
                            {{ $quote->publisher->name }} <div>{{ $quote->category }}</div>
                        </span>
                    </div>
                </div>
            </div>
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
