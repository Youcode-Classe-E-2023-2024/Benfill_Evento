<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="{{ url('/css/dashboard.css') }}">
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>


<div x-data="setup()" :class="{ 'dark': isDark }">
    <div
        class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">

        <x-dashboard.headerdash/>
        <x-dashboard.sidebardash/>

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
                    <div class="flex justify-between px-6">

                        @if(Auth::user()->can('event-create'))
                            <button data-modal-target="crud-modal3" data-modal-toggle="crud-modal3"
                                    class="middle none center rounded-lg bg-blue-500 mb-10 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    data-ripple-light="true">
                                Add Event
                            </button>
                        @endif
                        @if(Auth::user()->can('accept-event'))
                            <button
                                id="event-request-btn"
                                class="relative middle none center rounded-lg bg-gray-500 mb-10 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">

                                <span class="inline-block">
                                    Event Request
                                </span>
                                <span
                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full px-2 py-1 text-xs font-bold">
                                    {{count($eventsRequest)}}
                            </span>

                            </button>

                            <button
                                id="event-list-btn"
                                class="hidden relative middle none center rounded-lg bg-gray-500 mb-10 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <span class="inline-block">
                                    Event List
                                </span>

                            </button>

                        @endif

                    </div>

                    {{--  Event List  --}}
                    <div
                        id="event-list"
                        class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Event Id</th>
                                    <th class="px-4 py-3">Description</th>
                                    <th class="px-4 py-3">Category</th>
                                    <th class="px-4 py-3">Location</th>
                                    <th class="px-4 py-3">Places</th>
                                    <th class="px-4 py-3">Price</th>
                                    <th class="px-4 py-3">Organizer</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Validation</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Created date</th>
                                    <th class="px-4 py-3 text-center">Operation</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @if (isset($events))
                                    @foreach ($events as $event)
                                        <tr
                                            class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm">{{ $event->title }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->description }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event['category']['category'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event['location']['location'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->places }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->price }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event['user']['name'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->status }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->validation }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->date }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $event->created_at->format('d-m-Y') }}</td>
                                            <td class="px-4 py-3 text-xs text-center">
                                                <form action="{{ route('events.destroy', $event->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class=" bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                                                        Delete Event
                                                    </button>
                                                </form>
                                                <button
                                                    data-event-id="{{$event->id}}"
                                                    class="updateBtn bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded"
                                                    type="button">
                                                    Update Event
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                    <div id="updateForm"
                                         class="hidden p-6">
                                        <form action="/event/updates/now" method="post"
                                              class="w-full px-20 py-12"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="eventId" name="eventId" value="">
                                            <div class="grid gap-4 mb-4 grid-cols-1">
                                                <div class="sm:col-span-1">
                                                    <label for="title"
                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                                    <input type="text" name="title" id="title"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                           placeholder="Enter Title"
                                                           value="{{$event['title']}}"
                                                           required>
                                                </div>

                                                <div class="sm:col-span-1">
                                                    <label for="description"
                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                                    <input type="text" name="description" id="description"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                           placeholder="Enter Description"
                                                           value="{{$event['description']}}"
                                                           required>
                                                </div>

                                                <div class="sm:col-span-1">
                                                    <label for="places"
                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Places</label>
                                                    <input type="number" placeholder="Enter Places"
                                                           name="places"
                                                           value="{{$event['places']}}" id="places"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>

                                                <div class="sm:col-span-1">
                                                    <label for="price"
                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                                    <input type="number" placeholder="Enter Price"
                                                           name="price"
                                                           value="{{$event['price']}}" id="price"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>

                                                <div class="sm:col-span-1">
                                                    <label for="date"
                                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                                    <input type="datetime-local" name="date" id="date"
                                                           value="{{$event['date']}}"
                                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                </div>
                                            </div>

                                            <div class="flex justify-between">
                                                <button type="submit"
                                                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Update
                                                </button>
                                                <button type="button"
                                                        id="cancelBtn"
                                                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <tr
                                        class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                        List is Empty
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <div class="my-12 flex justify-center">
                                {{ $events->links() }}
                            </div>
                        </div>
                    </div>

                    {{--  Event Request List  --}}

                    <div
                        id="event-request-list"
                        class="hidden w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Event Title</th>
                                    <th class="px-4 py-3">Description</th>
                                    <th class="px-4 py-3">Category</th>
                                    <th class="px-4 py-3">Location</th>
                                    <th class="px-4 py-3">Places</th>
                                    <th class="px-4 py-3">Price</th>
                                    <th class="px-4 py-3">Organizer</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Created date</th>
                                    <th class="px-4 py-3 text-center">Operation</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @if (count($events) !== 0)
                                    @foreach ($eventsRequest as $event)
                                        <tr
                                            class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                            <td class="px-4 py-3 text-sm">{{ $event->title }}</td>
                                            <td class="px-4 py-3 text-sm">{{ substr($event->description, 0, 40) }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event['category']['category'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event['location']['location'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->places }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->price }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event['user']['name'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->status }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $event->date }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                {{ $event->created_at->format('d-m-Y') }}</td>
                                            <td class="px-4 py-3 text-xs text-center">
                                                <form action="{{ route('events.status', $event->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    <div class="flex flex-row justify-between gap-4">
                                                        <button type="submit" name="accept"
                                                                class="bg-green-500 hover:bg-green-800 text-white font-semibold py-2 px-4 rounded">
                                                            Accept Event
                                                        </button>
                                                        <button type="submit"
                                                                name="cancel"
                                                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                                                            Remove Event
                                                        </button>
                                                    </div>
                                                </form>
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
                            <div class="my-12 flex justify-center">
                                {{ $eventsRequest->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<div id="crud-modal3" tabindex="-1" aria-hidden="true"
     class="hidden p-8 overflow-y-auto overflow-x-hidden h-full w-full fixed top-0 right-0 left-0 z-50 justify-center items-center max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add A New Event
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-10 h-10 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal3">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('events.store') }}" method="POST" class="w-full px-20 py-12"
                  enctype="multipart/form-data">
                @csrf

                <div class="grid gap-4 mb-4 grid-cols-1">
                    <div class="sm:col-span-1">
                        <label for="title"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Enter Title"
                               value="{{old('title')}}"
                               required>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" name="description" id="description"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Enter Description"
                               value="{{old('title')}}"
                               required>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="picture" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Picture</label>
                        <input type="file" accept="image" name="picture"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <div class="sm:col-span-1">
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Validation</label>
                        <select name="validation" id="location"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="{{old('validation')}}" selected disabled hidden>Choose Validation Option
                                here
                            </option>
                            <option value="auto" selected>Automatic</option>
                            <option value="manuel">Manual</option>
                        </select>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                        <select name="location" id="location"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="{{old('location')}}" selected disabled hidden>Choose Location here</option>
                            @foreach($locations as $location)
                                <option value="{{$location['id']}}">{{($location['location'])}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select name="category" id="category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected disabled hidden>Choose Category here</option>
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}">{{$category['category']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="places"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Places</label>
                        <input type="number" placeholder="Enter Places" name="places"
                               value="{{old('title')}}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <div class="sm:col-span-1">
                        <label for="price"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" placeholder="Enter Price" name="price"
                               value="{{old('title')}}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>

                    <div class="sm:col-span-1">
                        <label for="date"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                        <input type="datetime-local" name="date" id="date"
                               value="{{old('title')}}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
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


<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

<script src="{{ url('/js/dashboard.js') }}"></script>
<script src="{{ url('/js/eventRequest.js') }}"></script>
