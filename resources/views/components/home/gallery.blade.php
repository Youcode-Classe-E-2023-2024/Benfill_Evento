<style>
    .relative {
        position: relative;
    }

    .buy-now-button {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        color: #fff; /* Change this to your desired text color */
        padding: 10px 70px;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .shadow-md:hover .buy-now-button {
        opacity: 1;
    }

</style>

<div
    class="w-full border-gray-200 border-b-4 py-3"
    id="gallerySection"
    style="background-image: url('https://www.guichet.com/static/media/bg.5d471928ee32bd253533.png');
    background-size: 100%;
      background-repeat: no-repeat;
    ">
    <div id="custom-controls-gallery"
         class="relative w-full"
         data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            @foreach($gallery as $item)
                <a href="/events/{{$item['slug']}}">
                    <div class="shadow-md hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{getPicUrl($item['picture'], '')}}"
                             class="rounded-lg shadow-md absolute block max-w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                             alt="">
                        <div class="w-1-2 buy-now-button mb-6 hover:bg-blue-900 bg-blue-600">Buy Now</div>
                    </div>
                </a>

            @endforeach
        </div>
        <div class="flex justify-center items-center pt-4">
            <button type="button"
                    class="flex justify-center items-center me-4 h-full cursor-pointer group focus:outline-none"
                    data-carousel-prev>
            <span
                class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                <svg class="rtl:rotate-180 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
            </button>
            <button type="button"
                    class="flex justify-center items-center h-full cursor-pointer group focus:outline-none"
                    data-carousel-next>
            <span
                class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                <svg class="rtl:rotate-180 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
            </button>
        </div>
    </div>
</div>
