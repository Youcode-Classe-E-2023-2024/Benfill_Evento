<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="{{ url('/css/dashboard.css') }}">


<div x-data="setup()" :class="{ 'dark': isDark }">
    <div
        class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">

        <x-dashboard.headerdash />
        <x-dashboard.sidebardash />

        <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
            @if (session('success'))
                <div class="max-w-4xl mx-auto px-4">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Success</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-1 xl:grid-cols-1 gap-4 text-black dark:text-white">
                <div class="mt-4 mx-4">
                    @if(Auth::user()->can('category-create'))
                        <button data-modal-target="crud-modal3" data-modal-toggle="crud-modal3"
                                class="middle none center rounded-lg bg-red-500 mb-10 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true">
                            Add Category
                        </button>
                    @endif
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Category</th>
                                    <th class="px-4 py-3">Created date</th>
                                    <th class="px-4 py-3 text-center">Operation</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @if (isset($categories))
                                    @foreach ($categories as $category)
                                        <tr
                                            class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm">{{ $category->category }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $category->created_at->format('d-m-Y') }}</td>
                                            <td class="px-4 py-3 text-xs text-center">
                                                @if(Auth::user()->can('category-delete'))
                                                    <form action="{{ route('category.destroy', $category->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class=" bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                                                            Delete Category
                                                        </button>
                                                    </form>
                                                @endif
                                                {{--                                                    <button data-modal-target="crud-modal2"--}}
                                                {{--                                                        data-modal-toggle="crud-modal2"--}}
                                                {{--                                                        class=" bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded"--}}
                                                {{--                                                        type="button">--}}
                                                {{--                                                        Update Category--}}
                                                {{--                                                    </button>--}}

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr
                                        class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                        List is Empty
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<div id="crud-modal2" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Modify the Current Category
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            {{-- <form class="p-4 md:p-5" action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="sm:col-span-1">
                        <label for="category"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <input type="text" name="category" id="name" value="{{ $category->category }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Type product name" required="">
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Change the Category
                </button>
            </form> --}}
        </div>
    </div>
</div>

<div id="crud-modal3" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add A New Catgeory
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form class="p-4 md:p-5" action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="sm:col-span-1">
                        <label for="category"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <input type="text" name="category" id="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Type Category Name" required="">
                    </div>
                </div>
                <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Create
                </button>
            </form>
        </div>
    </div>
</div>


<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

<script src="{{ url('/js/dashboard.js') }}"></script>
