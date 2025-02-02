@php use App\Models\Client; @endphp
@props([
    'item' => $item ?? null,
    'type' => $type,
    'mode' => $mode,
    'config' => [
        'clients' => [
            'title' => 'Client',
            'routes' => [
                'store' => 'clients.store',
                'update' => 'clients.update',
                'index' => 'clients.index'
            ],
            'fields' => [
                [
                    'name' => 'name',
                    'label' => 'Name',
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'Enter name'
                ],
                [
                    'name' => 'surname',
                    'label' => 'Surname',
                    'type' => 'text',
                    'required' => true,
                    'placeholder' => 'Enter surname'
                ]
            ]
        ],
        'payments' => [
            'title' => 'Payment',
            'routes' => [
                'store' => 'payments.store',
                'update' => 'payments.update',
                'index' => 'payments.index'
            ],
            'fields' => [
                [
                    'name' => 'client_id',
                    'label' => 'Client',
                    'type' => 'select',
                    'required' => true,
                    'placeholder' => ''
                ],
                [
                    'name' => 'amount',
                    'label' => 'Amount',
                    'type' => 'number',
                    'required' => true,
                    'placeholder' => 'Enter amounts'
                ]
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
        $fields = $currentConfig['fields'];

     $isEdit = $mode === 'edit';

        $formRoute = $isEdit
            ? route($routes['update'], $item->id)
            : route($routes['store']);
        $method = $isEdit ? 'PUT' : 'POST';
@endphp

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                {{ $isEdit ? "Edit $title" : "Create New $title" }}
            </h2>
        </div>

        <form action="{{ $formRoute }}" method="POST" class="space-y-6">
            @csrf
            @if($isEdit)
                @method($method)
            @endif

            @foreach($fields as $field)
                @php
                    $showField = !isset($field['show_on']) ||
                                ($field['show_on'] === 'create' && !$isEdit) ||
                                ($field['show_on'] === 'edit' && $isEdit);

                    if (!$showField) continue;

                    $fieldName = $field['name'];
                    $fieldValue = old($fieldName, data_get($item, $fieldName));
                @endphp

                <div class="space-y-1">
                    <label for="{{ $fieldName }}"
                           class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ $field['label'] }}
                        @if($field['required'])
                            <span class="text-red-500">*</span>
                        @endif
                    </label>
                    @switch($field['type'])
                        @case('select')
                            <select id="{{ $fieldName }}"
                                    name="{{ $fieldName }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                       @error($fieldName) border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                    @if($field['required']) required @endif>
                                <option value="">Select {{ $field['label'] }}</option>
                                @foreach(Client::all() as $client)
                                    <option value="{{ $client->id }}"
                                        @selected(old($fieldName, data_get($item, $fieldName)) == $client->id)>
                                        {{ $client->name }} {{ $client->surname }}
                                    </option>
                                @endforeach
                            </select>
                            @break

                        @case('number')
                            <input type="number"
                                   id="{{ $fieldName }}"
                                   name="{{ $fieldName }}"
                                   value="{{ $fieldValue }}"
                                   step="0.01"
                                   min="0"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                      @error($fieldName) border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                   placeholder="{{ $field['placeholder'] ?? '' }}"
                                   @if($field['required']) required @endif>
                            @break

                        @default
                            <input type="{{ $field['type'] }}"
                                   id="{{ $fieldName }}"
                                   name="{{ $fieldName }}"
                                   value="{{ $fieldValue }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                      @error($fieldName) border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                                   placeholder="{{ $field['placeholder'] ?? '' }}"
                                   @if($field['required']) required @endif>
                    @endswitch

                    @error($fieldName)
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route($routes['index']) }}"
                   class="inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 py-2 px-4 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ $isEdit ? 'Update' : 'Create' }} {{ $title }}
                </button>
            </div>
        </form>
    </div>
</div>
