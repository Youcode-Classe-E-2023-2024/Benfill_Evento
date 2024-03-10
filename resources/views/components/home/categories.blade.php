<div class="overflow-x-auto">
    <div class="flex space-x-4 p-4 justify-center">
        <div id="homeBtn" class="font-bold hover:text-blue-500 cursor-pointer text-gray-700 px-4 py-2 rounded font-sans">Home
        </div>
        @foreach($categories as $category)
            <div data-category-id="{{$category['id']}}"
                 class="font-bold hover:text-blue-500 categorySelect bg-white cursor-pointer text-gray-700 px-4 py-2 rounded font-sans">{{$category['category']}}</div>
        @endforeach
    </div>
</div>
