<div id="categoriesModal" class="hidden fixed z-10 top-0 left-0 overflow-auto bg-black bg-opacity-25 w-full h-full">
    <div
        class="flex container m-40 flex-col mx-auto items-center justify-center bg-white dark:bg-gray-800 rounded-lg shadow">
        <ul class="flex flex-col divide divide-y w-full">
            @foreach($allCategories as $category)
                <li id="category{{$category['id']}}" class="flex flex-row w-full" wire:click="$emit('select-category', {{$category['id']}})">
                    <div class="select-none cursor-pointer flex flex-1 items-center p-4">
                        <div class="flex-1 pl-1 mr-16">
                            <div class="font-medium dark:text-white text-center">
                                {{$category['name']}}
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<script>
    modal = document.querySelector('#categoriesModal');
    bodyComponent = document.querySelector("body");
    selectedCategories = [];
    window.livewire.on('open-categories-modal', function() {
        modal.style.display = "block";
        bodyComponent.style.overflowY = "hidden";
    });
    window.livewire.on('hide-categories-modal', function() {
        modal.style.display = "none";
        bodyComponent.style.overflowY = "scroll";
    });
    window.livewire.on('select-category', categoryId => {
        categoryIndex = selectedCategories.indexOf(categoryId);
        categoryComponent = document.querySelector("#category"+categoryId);
        if(categoryIndex > -1){
            selectedCategories.splice(categoryIndex, 1);
            categoryComponent.style.color = "black";
            categoryComponent.style.backgroundColor = "white";
        }
        else{
            selectedCategories.push(categoryId);
            categoryComponent.style.color = "white";
            categoryComponent.style.backgroundColor = "gray";
        }
    });
    modal.onclick = function(event) {
        if (event.target == modal) {
            window.livewire.emit("hide-categories-modal");
        }
    };
</script>
