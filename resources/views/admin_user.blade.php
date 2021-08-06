<x-app-layout>
    <div class="container mt-20 max-w-2xl mx-auto shadow-md md:w-3/4">
        <div class="p-4 bg-gray-100 border-t-2 border-indigo-400 rounded-lg bg-opacity-5">
            <div class="max-w-sm mx-auto md:w-full md:mx-0">
                <div class="inline-flex items-center space-x-4">
                    <img alt="profil" src="{{ $user->getProfilePhotoUrlAttribute() }}" class="mx-auto object-cover rounded-full h-16 w-16 " />
                    <h1 class="text-gray-600">
                        id: {{ $user->id }}, {{ $user->name }}
                    </h1>
                </div>
            </div>
        </div>
        <form>
            <hr />
            <div class="space-y-6 bg-white">
                <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                    <h2 class="max-w-sm mx-auto md:w-1/3">
                        Account
                    </h2>
                    <div class="max-w-sm mx-auto md:w-2/3">
                        <div class=" relative ">
                            <input type="text" id="user-info-email"
                                class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                placeholder="Email" value="{{ $user->email }}" />
                        </div>
                        <div class=" relative ">
                            Администратор: <input type="checkbox" id="user-info-is-admin" @if ($user->is_admin === 1) checked @endif />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                    <h2 class="max-w-sm mx-auto md:w-1/3">
                        Персональная информация
                    </h2>
                    <div class="max-w-sm mx-auto space-y-5 md:w-2/3">
                        <div>
                            <div class=" relative ">
                                <input type="text" id="user-info-name"
                                    class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    placeholder="Имя" value="{{ $user->name }}" />
                            </div>
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
            </div>
        </form>
        {{-- <hr />
        <form method="post" action="{{ route('admin_api_reset_user_password', ['id'=>$user->id]) }}" class="items-center w-full p-8 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
            @csrf
            <h2 class="max-w-sm mx-auto md:w-4/12">
                Сменить пароль
            </h2>
            <div class="w-full max-w-sm pl-2 mx-auto space-y-5 md:w-5/12 md:pl-9 md:inline-flex">
                <div class=" relative ">
                    <input type="text" id="user-info-password" name="password"
                        class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                        placeholder="Пароль" />
                </div>
            </div>
            <div class="text-center md:w-3/12 md:pl-6">
                <button type="submit"
                    class="py-2 px-4  bg-pink-600 hover:bg-pink-700 focus:ring-pink-500 focus:ring-offset-pink-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                    Сменить
                </button>
            </div>
        </form> --}}
    </div>
</x-app-layout>
