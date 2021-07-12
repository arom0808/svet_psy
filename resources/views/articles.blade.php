<x-app-layout>
    @if(isset($searchExpression))
        @livewire('articles-list', ['searchExpression'=>$searchExpression])
    @else
        @livewire('articles-list')
    @endif
</x-app-layout>
