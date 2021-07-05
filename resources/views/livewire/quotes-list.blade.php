<div class="w-full bg-white" id="quotes_list">
    <div class="bg-white header flex justify-center m-12 flex-col items-center sm:flex-row sm:justify-between">
        <p class="title text-4xl font-bold text-gray-800 mb-4"> Lastest quotes </p>
        <div class="text-end">
            <form class="flex w-full max-w-sm space-x-3">
                <div class=" relative ">
                    <input type="text" id="&quot;form-subscribe-Search"
                        class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                        placeholder="Enter" />
                </div>
                <button
                    class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200"
                    type="submit">
                    Search
                </button>
            </form>
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
        {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
        @for($i = 0;$i < count($quotes); ++$i)
            <div class="w-full flex flex-col md:flex-row gap-4 mb-8 md:mb-0 flex-between items-center p-8 m-4">
                <div class="bg-white dark:bg-gray-800 w-72 shadow-lg mx-auto rounded-xl p-4">
                    <p class="text-gray-600 dark:text-white">
                        <span class="font-bold text-indigo-500 text-lg">“</span>
                        {{$quotes[$i]->text}}
                        <span class="font-bold text-indigo-500 text-lg">”</span>
                    </p>
                    <div class="flex items-center mt-4">
                        <div class="block relative">
                            <img alt="profil" src="{{$quotes[$i]->publisher->profile_photo_url}}" class="mx-auto object-cover rounded-full h-10 w-10 " />
                        </div>
                        <div class="flex flex-col ml-2 justify-between">
                            <span class="dark:text-gray-400 text-xs italic flex items-center">
                                {{$quotes[$i]->author}}
                            </span>
                            <span class="font-semibold text-indigo-500 text-sm">
                                {{$quotes[$i]->publisher->name}}, <div>{{$quotes[$i]->category}}</div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
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
