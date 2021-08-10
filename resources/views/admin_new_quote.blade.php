<x-app-layout>
    <section class="min-h-screen h-full bg-gray-100 bg-opacity-50">
        <div class="container max-w-6xl mx-auto shadow-md md:w-3/4">
            <div class="space-y-6 bg-white">
                <form method="POST" action="{{ route('admin_new_quote_post') }}">
                    @csrf
                    <input type="hidden" name="callback" value="{{ route('admin_quotes') }}" />
                    <input type="hidden" name="publisher_id" value="{{ Auth::id() }}" />
                    <textarea class="w-full" name="text"></textarea>
                    <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                        <h2 class="max-w-sm mx-auto md:w-1/3">
                            Категория
                        </h2>
                        <div class="max-w-sm mx-auto space-y-5 md:w-2/3">
                            <div class=" relative ">
                                <input type="text"
                                    class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    name="category" />
                            </div>
                        </div>
                    </div>
                    <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                        <h2 class="max-w-sm mx-auto md:w-1/3">
                            Автор
                        </h2>
                        <div class="max-w-sm mx-auto space-y-5 md:w-2/3">
                            <div class=" relative ">
                                <input type="text"
                                    class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    name="author" />
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="w-full px-4 pb-4 ml-auto text-gray-500 md:w-1/3">
                        <button type="submit"
                            class="py-2 px-4  bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
