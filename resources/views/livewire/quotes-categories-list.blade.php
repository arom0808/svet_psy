<div id="categories_list">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @for ($i = 0; $i < count($categories); $i += 3)
        <div class="w-full flex flex-col md:flex-row gap-4 mb-8 md:mb-0 flex-between items-center p-8 m-4">
            @for ($j = $i; $j < min($i + 3, count($categories)); ++$j)
                <a href="{{ route('quotes-category', ['categoryId' => $categories[$j]->id]) }}" class="w-72 mx-auto">
                    <div class="bg-white dark:bg-gray-800 w-72 shadow-lg mx-auto rounded-xl p-4">
                        <p class="text-gray-600 dark:text-white text-center">{{ $categories[$j]->name }}</p>
                    </div>
                </a>
            @endfor
        </div>
    @endfor
    @if (count($categories) == 0)
        <p>Ничего нету</p>
    @endif
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
</div>
