<div class="flex justify-end items-center mb-2 mt-20">
    @if(\Illuminate\Support\Facades\Auth::user()->can('role-create'))
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 font-bold " type="button">
            Create Role
        </button>
    @endif
</div>
@if (session('success'))
    <div class="max-w-4xl mx-auto px-4 absolute z-50 left-[15rem] top-[2.8rem]">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
    </div>
@endif
@if (session('error'))
    <div class="max-w-4xl mx-auto px-4 absolute z-50 left-[15rem] top-[2.8rem]">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <p class="font-bold">Error</p>
            <p>{{ session('error') }}</p>
        </div>
    </div>
@endif
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 id="update_role_title" class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New Role
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('create_role') }}" method="post" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-2 mb-4 grid-cols-1">
                    {{--                    @if(session('success'))--}}
                    {{--                        <p class="text-green-500 text-sm">{{ session('success') }}</p>--}}
                    {{--                    @endif--}}
                    <div class="col-span-2">
                        <label for="name" class=" block mb-2 text-xl font-medium text-gray-900 dark:text-white">Role Name</label>
                        <input type="text" name="role_name" id="role_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        @error('role_name')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        <h1 class="text-xl "> Choose Permissions</h1>
                        <div>
                            @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                                <div class="w-full border-b">
                                    <p class="">{{ $permission->name }}</p>
                                    <input class="mb-1" name="permissions[]" type="checkbox" value="{{ $permission->name }}">
                                </div>
                            @endforeach
                        </div>
                        @if(session('permissions'))
                            <p class="text-sm text-red-500">{{ session('permissions') }}</p>
                        @endif
                    </div>
                </div>
                <button id="add_role" type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new Role
                </button>
            </form>
        </div>
    </div>
</div>


<!-- Roles Table -->
<div class="flex flex-col items-end h-screen">
    <div class="w-3/4 overflow-x-auto mb-4">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
            <tr>
                <th class="px-4 py-2 bg-gray-200 text-left">ID</th>
                <th class="px-4 py-2 bg-gray-200 text-left">Role Name</th>
                <th class="px-4 py-2 bg-gray-200 text-left">Permissions</th>
                <th class="px-4 py-2 bg-gray-200"></th> <!-- Empty header for actions -->
            </tr>
            </thead>
            <tbody>
            @foreach(\Spatie\Permission\Models\Role::all() as $role)
                <tr>
                    <td class="border px-4 py-2">{{ $role->id }}</td>
                    <td class="border px-4 py-2">{{ $role->name }}</td>
                    <td class="border px-4 py-2">{{ implode(', ', $role->permissions->pluck('name')->toArray()) }}</td>
                    <td class="border px-4 py-2">

                        @if(Auth::user()->can('role-delete'))
                            <div class="flex">
                                <form action="{{ route('destroy_role', ['role_id' => $role->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mr-2 bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-sm">Delete</button>
                                </form>
                            </div>
                        @endif

                        @if(Auth::user()->can('role-edit'))
                            <button data-modal-target="update-modal" data-modal-toggle="update-modal"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded-sm"
                                    type="button"
                                    value="{{ $role->name }}"
                                    onclick="document.getElementById('to_update_role_name').value = this.value;">
                                Edit
                            </button>
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- -->

<div id="update-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update this Role
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="update-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form class="p-4 md:p-5" method="POST" action="/update_role">
                @csrf
                @method('PUT')
                <label for="name" class=" block mb-2 text-xl font-medium text-gray-900 dark:text-white">
                    Role Name
                </label>
                <input type="text" name="updated_role_name" id="to_update_role_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                <h1 class="text-xl ">Choose new permissions for this role</h1>
                <div>
                    @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                        <div class="w-full border-b">
                            <p class="text-white">{{ $permission->name }}</p>
                            <input class="mb-1" name="updated_permissions[]" type="checkbox" value="{{ $permission->name }}">
                        </div>
                    @endforeach
                </div>
                <!-- Assuming you know the user's ID you want to update -->
                {{--                <input type="hidden" name="userId" value="{{ $user->id }}">--}}
                <button type="submit" class="text-white inline-flex items-center bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Update role
                </button>
            </form>

        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

