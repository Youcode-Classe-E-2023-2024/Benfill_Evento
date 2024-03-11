<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="{{ url('/css/dashboard.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


<div x-data="setup()" :class="{ 'dark': isDark }">
    <div
        class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">

        <x-dashboard.headerdash/>

        <x-dashboard.sidebardash/>

        <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
            <x-dashboard.statisticscards/>
            <div style="display: flex; justify-content: space-between;">
                <div style="width: 45%;">
                    <canvas id="eventsByCategoryChart" width="400" height="400"></canvas>
                </div>
                <div style="width: 45%;">
                    <canvas id="eventsByAcceptationMethodChart" width="400" height="400"></canvas>
                </div>
            </div>

            <script>
                // Chart for Number of Events per Category
                var categories = {!! json_encode($categories->pluck('name')) !!};
                var eventsCount = {!! json_encode($categories->pluck('events_count')) !!};

                var ctx1 = document.getElementById('eventsByCategoryChart').getContext('2d');
                var eventsByCategoryChart = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: categories,
                        datasets: [{
                            label: 'Number of Events',
                            data: eventsCount,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

                // Chart for Percentage of Events by Acceptation Method
                var acceptationMethods = {!! json_encode($users->pluck('acceptation_method')) !!};
                var acceptationMethodCounts = {!! json_encode($users->pluck('count')) !!};

                var ctx2 = document.getElementById('eventsByAcceptationMethodChart').getContext('2d');
                var eventsByAcceptationMethodChart = new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        labels: acceptationMethods,
                        datasets: [{
                            label: 'Percentage of Events',
                            data: acceptationMethodCounts,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
            <!-- Client Table -->
            <div class="mt-4 mx-4">
                <h3 class="text-lg font-semibold pb-4">Users</h3>
                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Image</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Created date</th>
                                <th class="px-4 py-3 text-center">Operation</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @foreach ($users as $user)
                                <tr
                                    class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full"
                                                     src="{{ asset('storage/'. $user->picture) }}" alt=""
                                                     loading="lazy"/>
                                                <div class="absolute inset-0 rounded-full shadow-inner"
                                                     aria-hidden="true">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $user->email }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        @if(Auth::user()->can('update-user-role'))
                                            <form action="/update_user_role/{{$user->id}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex items-center space-x-2">
                                                    <select name="updated_role"
                                                            class="p-1 border border-gray-300 rounded-sm text-sm">
                                                        @foreach($roles as $role)
                                                            <option
                                                                value="{{ $role->name }}" {{ $user->getRoleNames()->first() === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit"
                                                            class="px-2 py-1 bg-blue-500 text-white rounded-sm text-sm">
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        @else
                                            {{ $user->getRoleNames()->first() }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td class="px-4 py-3 text-xs text-center">
                                        @if(Auth::user()->can('delete-user'))
                                            <form action="/delete_user/{{$user->id}}" method="POST"
                                                  onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class=" bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
                                                    Delete User
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    </li>
                    </ul>
                    </nav>
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>


<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

<script src="{{ url('/js/dashboard.js') }}"></script>
