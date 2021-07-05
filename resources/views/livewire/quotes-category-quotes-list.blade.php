<div id="quotes_list">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @for($i = 0;$i < count($quotes); $i+=3) <div
        class="w-full flex flex-col md:flex-row gap-4 mb-8 md:mb-0 flex-between items-center p-8 m-4">
        @for($j = $i;$j < min($i+3, count($quotes));++$j) <div
            class="bg-white dark:bg-gray-800 w-72 shadow-lg mx-auto rounded-xl p-4">
            <p class="text-gray-600 dark:text-white">
                <span class="font-bold text-indigo-500 text-lg">“</span>{{$quotes[$j]->text}}<span
                    class="font-bold text-indigo-500 text-lg">”</span>
            </p>
            <div class="flex items-center mt-4">
                <div class="block relative">
                    <img alt="profil" src="{{$quotes[$j]->publisher->profile_photo_url}}"
                        class="mx-auto object-cover rounded-full h-10 w-10 " />
                </div>
                <div class="flex flex-col ml-2 justify-between">
                    <span class="dark:text-gray-400 text-xs italic flex items-center">
                        {{$quotes[$j]->author}}
                    </span>
                    <span class="font-semibold text-indigo-500 text-sm">
                        {{$quotes[$j]->publisher->name}}@if($quotes[$j]->category),
                        <a
                            href="{{ route('quotes-category', ['categoryId' => $quotes[$j]->category->id]) }}">{{$quotes[$j]->category->name}}</a>@endif
                    </span>
                </div>
            </div>
</div>
@endfor
</div>
@endfor
@if(count($quotes)==0)
<p>Ничего нету</p>
@endif
<script type="text/javascript">
    is_loading = false;
    window.livewire.on('userStore', function () {is_loading = false;});
    window.onscroll = function (ev) {
        if ((is_loading === false) && ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight)) {
            is_loading = true;
            window.livewire.emit('load-more');
        }
    }
</script>
</div>
