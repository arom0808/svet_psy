@php
$page_number = $page_index;
$pages_arr = [];
if ($pages_count <= 7) {
    for ($i = 1; $i <= $pages_count; ++$i) {
        $pages_arr[$i - 1] = $i === $page_number ? '.' . strval($i) : strval($i);
    }
} else {
    $pages_arr = ['1', '', '', '', '', '', strval($pages_count)];
    $current_page_array_index = 0;
    if ($page_number <= 3) {
        $current_page_array_index = $page_number - 1;
    } elseif ($page_number >= $pages_count - 2) {
        $current_page_array_index = $page_number - $pages_count - 1 + 7;
    } else {
        $current_page_array_index = 3;
    }
    if ($current_page_array_index === 0) {
        $pages_arr = ['.1', '2', '3', '...', strval($pages_count - 2), strval($pages_count - 1), strval($pages_count)];
    }
    if ($current_page_array_index === 1) {
        $pages_arr = ['1', '.2', '3', '4', '...', strval($pages_count - 1), strval($pages_count)];
    }
    if ($current_page_array_index === 2) {
        $pages_arr = ['1', '2', '.3', '4', '5', '...', strval($pages_count)];
    }
    if ($current_page_array_index === 3) {
        $pages_arr = ['1', '...', strval($page_number - 1), '.' . strval($page_number), strval($page_number + 1), '...', strval($pages_count)];
    }
    if ($current_page_array_index === 4) {
        $pages_arr = ['1', '...', strval($pages_count - 4), strval($pages_count - 3), '.' . strval($pages_count - 2), strval($pages_count - 1), strval($pages_count)];
    }
    if ($current_page_array_index === 5) {
        $pages_arr = ['1', '2', '...', strval($pages_count - 3), strval($pages_count - 2), '.' . strval($pages_count - 1), strval($pages_count)];
    }
    if ($current_page_array_index === 6) {
        $pages_arr = ['1', '2', '3', '...', strval($pages_count - 2), strval($pages_count - 1), '.' . strval($pages_count)];
    }
}
@endphp


<x-app-layout>
    <div>
        <div class="flex absolute w-full z-10" style="height: 90%">
            <div class="relative shadow-lg rounded-2xl p-4 bg-white dark:bg-gray-800 w-64 m-auto">
                <div class="w-full h-full text-center">
                    <div class="flex h-full flex-col justify-between">
                        <svg width="40" height="40" class="mt-4 w-12 h-12 m-auto text-indigo-500" fill="currentColor"
                            viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z">
                            </path>
                        </svg>
                        <p class="text-gray-800 dark:text-gray-200 text-xl font-bold mt-4">
                            Remove card
                        </p>
                        <p class="text-gray-600 dark:text-gray-400 text-xs py-2 px-6">
                            Are you sure you want to delete this card ?
                        </p>
                        <div class="flex items-center justify-between gap-4 w-full mt-8">
                            <button type="button"
                                class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Delete
                            </button>
                            <button type="button"
                                class="py-2 px-4  bg-white hover:bg-gray-100 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-4 sm:px-8 max-w-3xl">
            <div class="py-8">
                <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
                    <h2 class="text-2xl leading-tight">
                        Пользователи
                    </h2>
                    <form
                        class="flex flex-col md:flex-row w-3/4 md:w-full max-w-sm md:space-x-3 space-y-3 md:space-y-0 justify-center">
                        <div class="relative">
                            <input type="text" id="&quot;form-subscribe-Filter" name="search"
                                class=" rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                placeholder="Фильтер" value='{{ $search_expression }}' />
                        </div>
                        <button
                            class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-purple-600 rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-purple-200"
                            type="submit">
                            Поиск
                        </button>
                    </form>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Id
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Имя
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Электронная почта
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Роль
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Дата создания
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-5 py-5 text-center border-b border-gray-200 bg-white text-sm">
                                            {{ $user->id }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <img alt="profil" src="{{ $user->getProfilePhotoUrlAttribute() }}"
                                                        class="mx-auto object-cover rounded-full h-10 w-10 " />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $user->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->email }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                @if ($user->is_admin)
                                                    Админ
                                                @else
                                                    Пользователь
                                                @endif
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->created_at }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <button type="button" class="@if ($user->is_banned ===
                                            1) text-red-600 hover:text-red-900 @else text-indigo-600
                                                hover:text-indigo-900 @endif">
                                                <svg class="h-6 w-6 text-indigo-500" fill="currentColor"
                                                    viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button type="button" class="text-indigo-600 hover:text-indigo-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-5 bg-white py-5 flex flex-col xs:flex-row items-center xs:justify-between">
                            <div class="flex items-center">
                                @if ($page_number == 1)
                                    <div
                                        class="w-full p-4 border text-base rounded-l-xl text-gray-600 bg-white hover:bg-gray-100">
                                        <svg width="9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1427 301l-531 531 531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19l-742-742q-19-19-19-45t19-45l742-742q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z">
                                            </path>
                                        </svg>
                                    </div>
                                @else
                                    <a href='{{ route('admin_users') . '?page=' . $page_number - 1 . ($search_expression === '' ? '' : '&search=' . $search_expression) }}'
                                        class="w-full p-4 border text-base rounded-l-xl text-gray-600 bg-white hover:bg-gray-100">
                                        <svg width="9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1427 301l-531 531 531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19l-742-742q-19-19-19-45t19-45l742-742q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z">
                                            </path>
                                        </svg>
                                    </a>
                                @endif
                                @foreach ($pages_arr as $page_str)
                                    @if ($page_str === '...')
                                        <button type="button"
                                            class="w-full px-4 py-2 border text-base text-gray-600 bg-white hover:bg-gray-100">
                                            ...
                                        </button>
                                    @elseif ($page_str[0] === '.')
                                        <button type="button" class="w-full px-4 py-2 @if ($pages_count==$page_number) border-r @endif
                                            border-t border-b text-base text-indigo-500 bg-white hover:bg-gray-100 ">
                                        {{ substr($page_str, 1) }}
                                    </button>
@else
                                    <a href='{{ route('admin_users') . '?page=' . $page_str . ($search_expression === '' ? '' : '&search=' . $search_expression) }}'
                                        class=" w-full px-4 py-2 border text-base text-gray-600 bg-white
                                            hover:bg-gray-100">
                                            {{ $page_str }}
                                            </a>
                                    @endif
                                @endforeach
                                @if ($pages_count == $page_number)
                                    <div
                                        class="w-full p-4 border-t border-b border-r text-base  rounded-r-xl text-gray-600 bg-white hover:bg-gray-100">
                                        <svg width="9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z">
                                            </path>
                                        </svg>
                                    </div>
                                @else <a
                                        href='{{ route('admin_users') . '?page=' . $page_number + 1 . ($search_expression === '' ? '' : '&search=' . $search_expression) }}'
                                        class="w-full p-4 border-t border-b border-r text-base  rounded-r-xl text-gray-600 bg-white hover:bg-gray-100">
                                        <svg width="9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z">
                                            </path>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
