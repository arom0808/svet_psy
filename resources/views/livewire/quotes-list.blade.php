<div id="quotes_list">
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @for($i = 0;$i < count($quotes); $i+=3)
    <div class="w-full flex flex-col md:flex-row gap-4 mb-8 md:mb-0 flex-between items-center p-8 m-4">
        @for($j = $i;$j < min($i+3, count($quotes));++$j)
        <div class="bg-white dark:bg-gray-800 w-72 shadow-lg mx-auto rounded-xl p-4">
            <p class="text-gray-600 dark:text-white">
            <span class="font-bold text-indigo-500 text-lg">“</span>{{$quotes[$j]->text}}<span class="font-bold text-indigo-500 text-lg">”</span>
            </p>
            <div class="flex items-center mt-4">
                <div class="block relative">
                    <img alt="profil" src="{{$quotes[$j]->publisher->profile_photo_url}}" class="mx-auto object-cover rounded-full h-10 w-10 "/>
                </div>
                <div class="flex flex-col ml-2 justify-between">
                    <span class="dark:text-gray-400 text-xs italic flex items-center">
                        {{$quotes[$j]->author}}
                    </span>
                    <span class="font-semibold text-indigo-500 text-sm">
                        {{$quotes[$j]->publisher->name}}@if($quotes[$j]->category), {{$quotes[$j]->category->name}}@endif
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
    @livewireScripts
    <script type="text/javascript">
        is_loading = false;
        window.livewire.on('userStore', function () {is_loading = false;});
        window.onscroll = function (ev) {
            if (!is_loading) {
                if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight) {
                    is_loading = true;
                    document.querySelector("#quotes_list").innerHTML+="<div class=\"flex flex-row w-full justify-center items-center\"><svg class=\"w-10 h-10\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 100 100\" enable-background=\"new 0 0 100 100\" xml:space=\"preserve\"> <circle fill=\"none\" stroke=\"#fff\" stroke-width=\"6\" stroke-miterlimit=\"15\" stroke-dasharray=\"14.2472,14.2472\" cx=\"50\" cy=\"50\" r=\"47\" > <animateTransform attributeName=\"transform\" attributeType=\"XML\" type=\"rotate\" dur=\"5s\" from=\"0 50 50\" to=\"360 50 50\" repeatCount=\"indefinite\"/> </circle> <circle fill=\"none\" stroke=\"#fff\" stroke-width=\"1\" stroke-miterlimit=\"10\" stroke-dasharray=\"10,10\" cx=\"50\" cy=\"50\" r=\"39\"> <animateTransform attributeName=\"transform\" attributeType=\"XML\" type=\"rotate\" dur=\"5s\" from=\"0 50 50\" to=\"-360 50 50\" repeatCount=\"indefinite\"/> </circle> <g fill=\"#fff\"> <rect x=\"30\" y=\"35\" width=\"5\" height=\"30\"> <animateTransform attributeName=\"transform\" dur=\"1s\" type=\"translate\" values=\"0 5 ; 0 -5; 0 5\" repeatCount=\"indefinite\" begin=\"0.1\"/> </rect> <rect x=\"40\" y=\"35\" width=\"5\" height=\"30\" > <animateTransform attributeName=\"transform\" dur=\"1s\" type=\"translate\" values=\"0 5 ; 0 -5; 0 5\" repeatCount=\"indefinite\" begin=\"0.2\"/> </rect> <rect x=\"50\" y=\"35\" width=\"5\" height=\"30\" > <animateTransform attributeName=\"transform\" dur=\"1s\" type=\"translate\" values=\"0 5 ; 0 -5; 0 5\" repeatCount=\"indefinite\" begin=\"0.3\"/> </rect> <rect x=\"60\" y=\"35\" width=\"5\" height=\"30\" > <animateTransform attributeName=\"transform\" dur=\"1s\" type=\"translate\" values=\"0 5 ; 0 -5; 0 5\" repeatCount=\"indefinite\" begin=\"0.4\"/> </rect> <rect x=\"70\" y=\"35\" width=\"5\" height=\"30\" > <animateTransform attributeName=\"transform\" dur=\"1s\" type=\"translate\" values=\"0 5 ; 0 -5; 0 5\" repeatCount=\"indefinite\" begin=\"0.5\"/> </rect> </g></svg></div>"
                    window.livewire.emit('load-more');
                }
            }
        }
    </script>
</div>
