@props([
    'item' => null,
    'type' => $type,
    'config' => [
        'clients' => [
            'title' => 'Client Details',
            'routes' => [
                'edit' => 'clients.edit',
                'index' => 'clients.index',
                'destroy' => 'clients.destroy'
            ],
            'sections' => [
                'basic' => [
                    'title' => 'Basic Information',
                    'fields' => [
                        ['key' => 'name', 'label' => 'Name'],
                        ['key' => 'surname', 'label' => 'Surname'],
                        ['key' => 'created_at', 'label' => 'Created At',],
                        ['key' => 'updated_at', 'label' => 'Last Updated']
                    ]
                ],
            ]
        ],

    ]
])

@php
/** @var  $type */
/** @var  $config */
    $currentConfig = $config[$type];
    $title = $currentConfig['title'];
    $routes = $currentConfig['routes'];
    $sections = $currentConfig['sections'];
@endphp

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                {{ $title }}
            </h2>

            <div class="mt-4 sm:mt-0 flex space-x-3">
                <a href="{{ route($routes['edit'], $item->id) }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Edit {{ Str::singular($type) }}
                </a>

                <form action="{{ route($routes['destroy'], $item->id) }}"
                      method="POST"
                      class="inline-block"
                      onsubmit="return confirm('Are you sure you want to delete this {{ Str::singular($type) }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="space-y-6">
            @foreach($sections as $sectionKey => $section)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
                            {{ $section['title'] }}
                        </h3>
                    </div>

                    <div class="px-4 py-5 sm:p-6">

                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <a href="{{ route($routes['index']) }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Back to {{ ucfirst($type) }}
            </a>
        </div>
    </div>
</div>
