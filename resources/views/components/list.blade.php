@php use Illuminate\Pagination\LengthAwarePaginator; @endphp

@props([
    'items' => [],
    'type' => $type,
    'config' => [
        'clients' => [
            'title' => 'Clients',
            'singular' => 'Client',
            'routes' => [
                'index' => 'clients.index',
                'create' => 'clients.create',
                'edit' => 'clients.edit',
                'destroy' => 'clients.destroy',
                'show' => 'clients.show'
            ],
            'columns' => [
                ['key' => 'name', 'label' => 'Name'],
                ['key' => 'surname', 'label' => 'Surname'],
                ['key' => 'created_at', 'label' => 'Created At']
            ]
        ],
    ]
])

@php
    /** @var $config  */
    /** @var $type  */
        $currentConfig = $config[$type];
        $title = $currentConfig['title'];
        $singular = $currentConfig['singular'];
        $routes = $currentConfig['routes'];
        $columns = $currentConfig['columns'];
@endphp

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $title }}</h1>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route($routes['create']) }}"
                   class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Add {{ $singular }}
                </a>
            </div>
        </div>

        @if ($errors?->any())
            <div class="mt-4 bg-red-50 dark:bg-red-900/50 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                            There were errors with your submission
                        </h3>
                        <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                            <ul role="list" class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="mt-4 bg-green-50 dark:bg-green-900/50 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle">
                    <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            @foreach($columns as $column)
                                <th scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 {{ $loop->first ? 'pl-4 sm:pl-6' : '' }}">
                                    {{ $column['label'] }}
                                </th>
                            @endforeach
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                        @forelse ($items as $item)
                            <tr>
                                @foreach($columns as $column)
                                    <td class="whitespace-nowrap px-3 py-4 text-sm {{ $loop->first ? 'pl-4 sm:pl-6 font-medium text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-300' }}">
                                        {{ data_get($item, $column['key']) }}
                                    </td>
                                @endforeach
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route($routes['show'], $item->id) }}"
                                           class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                            View
                                        </a>
                                        <a href="{{ route($routes['edit'], $item->id) }}"
                                           class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                            Edit
                                        </a>

                                        <form action="{{ route($routes['destroy'], $item->id) }}"
                                              method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this {{ strtolower($singular) }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($columns) + 1 }}"
                                    class="px-3 py-4 text-sm text-gray-500 dark:text-gray-300 text-center">
                                    No {{ strtolower($title) }} found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($items instanceof LengthAwarePaginator)
            <div class="mt-4">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</div>
