<x-app-layout>
    @if(isset($searchExpression))
        @livewire('quotes-list', ['searchExpression'=>$searchExpression])
    @else
        @livewire('quotes-list')
    @endif
</x-app-layout>
