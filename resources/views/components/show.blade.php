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
                'payments' => [
                    'title' => 'Payments',
                    'type' => 'relationship',
                    'relation' => 'payments',
                    'fields' => [
                        ['key' => 'amount', 'label' => 'Amount'],
                        ['key' => 'created_at', 'label' => 'Date']
                    ]
                ]
            ]
        ],
        'payments' => [
            'title' => 'Payment Details',
            'routes' => [
                'edit' => 'payments.edit',
                'index' => 'payments.index',
                'destroy' => 'payments.destroy'
            ],
            'sections' => [
                'basic' => [
                    'title' => 'Payment Information',
                    'fields' => [
                        ['key' => 'amount', 'label' => 'Amount'],
                        ['key' => 'created_at', 'label' => 'Date']
                    ]
                ],
                'client' => [
                    'title' => 'Client Information',
                    'type' => 'relationship',
                    'relation' => 'client',
                    'fields' => [
                        ['key' => 'name', 'label' => 'Name'],
                        ['key' => 'surname', 'label' => 'Surname']
                    ]
                ]
            ]
        ]
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
<div class="space-y-6">
    @foreach($sections as $sectionKey => $section)
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
                    {{ $section['title'] }}
                </h3>
            </div>

            <div class="px-4 py-5 sm:p-6">
                @if(isset($section['type']) && $section['type'] === 'relationship')
                    @php
                        /** @var  $item */
                        $relationData = $section['relation'] === 'client'
                            ? collect([$item->{$section['relation']}])
                            : $item->{$section['relation']};
                        $relatedItem = $item->{$section['relation']};
                    @endphp

                    <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-600">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        @foreach($section['fields'] as $field)
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 {{ $loop->first ? 'pl-4 sm:pl-6' : '' }}">
                                                {{ $field['label'] }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 dark:divide-gray-600 bg-white dark:bg-gray-800">
                                    @if($relationData->count() === 1)
                                        <tr>
                                            @foreach($section['fields'] as $field)
                                                <td class="whitespace-nowrap px-3 py-4 text-sm {{ $loop->first ? 'pl-4 sm:pl-6 font-medium text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-300' }}">
                                                    {{ data_get($relationData->first(), $field['key']) }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @elseif($relationData->count() > 0)
                                        @foreach($relationData as $relatedItem)
                                            <tr>
                                                @foreach($section['fields'] as $field)
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm {{ $loop->first ? 'pl-4 sm:pl-6 font-medium text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-300' }}">
                                                        {{ data_get($relatedItem, $field['key']) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="{{ count($section['fields']) }}"
                                                class="px-3 py-4 text-sm text-gray-500 dark:text-gray-300 text-center">
                                                No records found
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($section['fields'] as $field)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ $field['label'] }}
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $item[$field['key']] }}
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                @endif
            </div>
        </div>
    @endforeach
    <div class="mt-6">
        <a href="{{ route($routes['index']) }}"
           class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Back to {{ ucfirst($type) }}
        </a>
    </div>
</div>
