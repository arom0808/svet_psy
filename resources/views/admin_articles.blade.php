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
        <div class="container mx-auto px-4 sm:px-8 max-w-5xl">
            <div class="py-8">
                <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
                    <h2 class="text-2xl leading-tight">
                        Статьи
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
                                        Название
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Краткое описание
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Категория
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Написал
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Время на чтение
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                        Дата изменения
                                    </th>
                                    <th scope="col"
                                        class="px-5 py-3 bg-white  border-b text-indigo-600 hover:text-indigo-900">
                                        <a href="{{ route('admin_new_article') }}">New</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td class="px-5 py-5 text-center border-b border-gray-200 bg-white text-sm">
                                            {{ $article->id }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $article->title }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $article->short_description }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $article->category }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $article->publisher->name }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $article->time_to_read }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $article->updated_at->diffForHumans() }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <a href="{{ route('admin_article', ['id'=>$article->id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                                Edit
                                            </a>
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
                                    <a href='{{ route('admin_articles') . '?page=' . $page_number - 1 . ($search_expression === '' ? '' : '&search=' . $search_expression) }}'
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
                                    <a href='{{ route('admin_articles') . '?page=' . $page_str . ($search_expression === '' ? '' : '&search=' . $search_expression) }}'
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
                                        href='{{ route('admin_articles') . '?page=' . $page_number + 1 . ($search_expression === '' ? '' : '&search=' . $search_expression) }}'
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
