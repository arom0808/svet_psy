<x-app-layout>
    <div class="w-full bg-white" id="quotes_list">
        <div class="bg-white header flex justify-center m-12 flex-col items-center sm:flex-row sm:justify-between">
            <p class="title text-4xl font-bold text-gray-800 mb-4"> Последние цитаты </p>
            <div class="text-end">
                <div class=" relative ">
                    <input
                        oninput="window.livewire.emit('search', this.value)"
                        onchange="this.blur(); history.pushState(null, null, '/quotes/' + (this.value===''?'':'search/') + this.value);"
                        type="text"
                        class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                        @if(isset($searchExpression)) value="{{ $searchExpression }}" @endif placeholder="Search" />
                </div>
            </div>
        </div>
        @livewire('quotes-list', ['searchExpression' => (isset($searchExpression)?$searchExpression:'')])
    </div>
</x-app-layout>
