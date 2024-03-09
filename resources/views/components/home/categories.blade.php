<div class="overflow-x-auto">
    <div class="flex space-x-4 p-4 justify-center">
        <div id="homeBtn" class="hover:text-gray-900 cursor-pointer text-gray-700 px-4 py-2 rounded font-sans">Home
        </div>
        @foreach($categories as $category)
            <div data-category-id="{{$category['id']}}"
                 class="hover:text-gray-900 categorySelect bg-white cursor-pointer text-gray-700 px-4 py-2 rounded font-sans">{{$category['category']}}</div>
        @endforeach
    </div>
</div>
