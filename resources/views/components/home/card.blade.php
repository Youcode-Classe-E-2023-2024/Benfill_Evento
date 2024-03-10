<div class="px-10">
    <div id="emptySection" class="my-6 hidden flex justify-center w-full text-center">
        <p class="text-center">No Results... See More!
        </p>
    </div>
    <div
        id="cardsSection"
        class="grid h-full my-6 p-6 px-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-full">
        @foreach($events as $event)
            <div class="relative mx-auto w-full">
                <a href="/events/{{$event['slug']}}"
                   class="relative inline-block duration-300 ease-in-out transition-transform transform hover:-translate-y-2 w-full">
                    <div class="shadow p-4 rounded-lg bg-white">
                        <div class="flex justify-center relative rounded-lg overflow-hidden h-52">
                            <div class="transition-transform duration-500 transform ease-in-out hover:scale-110 w-full">
                                <div class="absolute inset-0 bg-black">
                                    <img
                                        class="relative z-50"
                                        src="{{getPicUrl($event['picture'], '')}}" alt="">
                                </div>
                            </div>

                            <div class="absolute flex justify-center bottom-0 mb-3">
                                <div class="flex bg-white px-4 py-1 space-x-5 rounded-lg overflow-hidden shadow">
                                    <p class="flex items-center font-medium text-gray-800">
                                        {{ $event['location']['location'] }}
                                    </p>

                                </div>
                            </div>

                            <span
                                class="absolute top-0 left-0 inline-flex mt-3 ml-3 px-3 py-2 rounded-lg z-10 bg-red-500 text-sm font-medium text-white select-none">
			{{ $event['category']['category'] }}
		  </span>
                        </div>

                        <div class="mt-4">
                            <h2 class="font-medium text-base md:text-lg text-gray-800 line-clamp-1" title="New York">
                                {{ $event->title }}
                            </h2>
                            <p class="mt-2 text-sm text-gray-800 line-clamp-1"
                               title="New York, NY 10004, United States">
                                {{ substr($event->description, 0, 40) }}
                            </p>
                        </div>

                        <div class="flex flex-col justify-center mt-8">
                            <p class="inline-flex flex-col xl:flex-row xl:items-center text-gray-800">
                                <svg class="inline-block w-5 h-5 xl:w-4 xl:h-4 mr-3 fill-current text-gray-800"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M399.959 170.585c-4.686 4.686-4.686 12.284 0 16.971L451.887 239H60.113l51.928-51.444c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0l-84.485 84c-4.686 4.686-4.686 12.284 0 16.971l84.485 84c4.686 4.686 12.284 4.686 16.97 0l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L60.113 273h391.773l-51.928 51.444c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l84.485-84c4.687-4.686 4.687-12.284 0-16.971l-84.485-84c-4.686-4.686-12.284-4.686-16.97 0l-7.07 7.071z"></path>
                                </svg>
                                <span
                                    class="dateSections mt-2 xl:mt-0">
			  {{ convertTimeFormat($event->date, "d") }}
			</span>
                            </p>
                            <p class="inline-flex flex-col xl:flex-row xl:items-center text-gray-800">
                                <svg class="inline-block w-5 h-5 xl:w-4 xl:h-4 mr-3 fill-current text-gray-800"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M532.01 386.17C559.48 359.05 576 325.04 576 288c0-80.02-76.45-146.13-176.18-157.94 0 .01.01.02.01.03C368.37 72.47 294.34 32 208 32 93.12 32 0 103.63 0 192c0 37.04 16.52 71.05 43.99 98.17-15.3 30.74-37.34 54.53-37.7 54.89-6.31 6.69-8.05 16.53-4.42 24.99A23.085 23.085 0 0 0 23.06 384c53.54 0 96.67-20.24 125.17-38.78 9.08 2.09 18.45 3.68 28 4.82C207.74 407.59 281.73 448 368 448c20.79 0 40.83-2.41 59.77-6.78C456.27 459.76 499.4 480 552.94 480c9.22 0 17.55-5.5 21.18-13.96 3.64-8.46 1.89-18.3-4.42-24.99-.35-.36-22.39-24.14-37.69-54.88zm-376.59-72.13l-13.24-3.05-11.39 7.41c-20.07 13.06-50.49 28.25-87.68 32.47 8.77-11.3 20.17-27.61 29.54-46.44l10.32-20.75-16.49-16.28C50.75 251.87 32 226.19 32 192c0-70.58 78.95-128 176-128s176 57.42 176 128-78.95 128-176 128c-17.73 0-35.42-2.01-52.58-5.96zm289.8 100.35l-11.39-7.41-13.24 3.05A234.318 234.318 0 0 1 368 416c-65.14 0-122-25.94-152.43-64.29C326.91 348.62 416 278.4 416 192c0-9.45-1.27-18.66-3.32-27.66C488.12 178.78 544 228.67 544 288c0 34.19-18.75 59.87-34.47 75.39l-16.49 16.28 10.32 20.75c9.38 18.86 20.81 35.19 29.53 46.44-37.19-4.22-67.6-19.41-87.67-32.47zM233.38 182.91l-41.56-12.47c-4.22-1.27-7.19-5.62-7.19-10.58 0-6.03 4.34-10.94 9.66-10.94h25.94c3.9 0 7.65 1.08 10.96 3.1 3.17 1.93 7.31 1.15 10-1.4l11.44-10.87c3.53-3.36 3.38-9.22-.54-12.11-8.18-6.03-17.97-9.58-28.08-10.32V104c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v13.4c-21.85 1.29-39.38 19.62-39.38 42.46 0 18.98 12.34 35.94 30 41.23l41.56 12.47c4.22 1.27 7.19 5.62 7.19 10.58 0 6.03-4.34 10.94-9.66 10.94h-25.94c-3.9 0-7.65-1.08-10.96-3.1-3.17-1.94-7.31-1.15-10 1.4l-11.44 10.87c-3.53 3.36-3.38 9.22.54 12.11 8.18 6.03 17.97 9.58 28.08 10.32V280c0 4.42 3.58 8 8 8h16c4.42 0 8-3.58 8-8v-13.4c21.85-1.29 39.38-19.62 39.38-42.46 0-18.98-12.35-35.94-30-41.23z"></path>
                                </svg>
                                <span class="mt-2 xl:mt-0">
			  {{ $event->places }} Places
			</span>
                            </p>
                        </div>

                        <div class="grid grid-cols-2 mt-8">
                            <div class="flex items-center">
                                <div class="relative">
                                    <div class="rounded-full w-6 h-6 md:w-8 md:h-8 bg-gray-200">
                                        <img src='{{ getPicUrl($event['user']['picture'], '') }}'
                                             alt=""
                                             class="rounded-full w-full h-full md:w-8 md:h-8">
                                    </div>
                                    <span
                                        class="absolute top-0 right-0 inline-block w-3 h-3 bg-primary-red rounded-full"></span>
                                </div>

                                <p class="ml-2 text-gray-800 line-clamp-1">
                                    {{ $event['user']['name'] }}
                                </p>
                            </div>

                            <div class="flex justify-end">
                                <p class="inline-block font-semibold text-primary whitespace-nowrap leading-tight rounded-xl">
			  <span class="text-sm uppercase">
			  </span>
                                    <span class="text-lg">{{ $event->price }}</span> MAD
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="flex justify-center">
        {{ $events->links() }}
    </div>
</div>
