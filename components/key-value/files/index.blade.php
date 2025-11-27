@props([
    'label' => null,
    'keyLabel' => 'Key',
    'valueLabel' => 'Value',
    'minRows' => 1,
    'maxRows' => null,
    'required' => false,
    'disabled' => false,
    'allowEmptyValues' => true,
    'preventDuplicateKeys' => true,
    'keyPlaceholder' => 'Enter key...',
    'valuePlaceholder' => 'Enter value...',
    'addButtonText' => 'Add Row',
    'showDuplicate' => true,
    'showTopBar' => true,
    'reorderable' => false,
    'errorClass' => 'text-red-500 text-sm mt-1',
])

@php
    $classes = $showDuplicate ? '[&_[data-col=actions]]:w-24' : '[&_[data-col=actions]]:w-14';  

    // Extract wire:model property and check if .live modifier exists
    $modelAttrs = collect($attributes->getAttributes())
        ->keys()
        ->first(fn($key) => str_starts_with($key, 'wire:model'));
    
    $model = $modelAttrs ? $attributes->get($modelAttrs) : null;

    $isLive = $modelAttrs && str_contains($modelAttrs, '.live');

@endphp

<div 
    x-data="function(){
        const $entangle = (prop, live) => {

            const binding = $wire.$entangle(prop);

            return live ? binding.live : binding;
        };

        const $initState = (prop, live) => {
            // when the env is not livewire
            if (!prop) return [];

            return  $entangle(prop, live);
        };

        return {
            state: $initState(@js($model), @js($isLive)),
            error: '',
            minRows: @js($minRows),
            maxRows: @js($maxRows),
            allowEmptyValues: @js($allowEmptyValues),
            preventDuplicateKeys: @js($preventDuplicateKeys),
            dragIndex: -1,
            
            init: function() {
                this.$nextTick(() => {
                    this.state = this.$el._x_model?.get() ?? [];

                    this.ensureMinRowsRequired();
                })

                this.$watch('state', (value) => {
                    // Sync with Alpine state
                    this.$root?._x_model?.set(value);
                });
            },

            ensureMinRowsRequired: function(){
                while (this.state.length < this.minRows) {
                    this.state.push({ key: '', value: '' });
                }
            },

            validateState: function() {
                this.error = '';
                
                // Check for duplicate keys if prevention is enabled
                if (this.preventDuplicateKeys) {
                    const keys = this.state
                        .map(row => row.key ? row.key.trim() : '')
                        .filter(key => key !== '');
                    
                    const duplicateKeys = keys.filter((key, index) => keys.indexOf(key) !== index);
                    
                    if (duplicateKeys.length > 0) {
                        this.error = `Duplicate keys found: ${[...new Set(duplicateKeys)].join(', ')}`;
                        return false;
                    }
                }
                
                // Check for empty values if not allowed
                if (!this.allowEmptyValues) {
                    const hasEmptyValues = this.state.some(row => {
                        const key = row.key ? row.key.trim() : '';
                        const value = row.value ? row.value.trim() : '';
                        return key !== '' && value === '';
                    });
                    
                    if (hasEmptyValues) {
                        this.error = 'All keys must have corresponding values.';
                        return false;
                    }
                }
                
                return true;
            },

            addRow: function() {
                if (this.maxRows && this.state.length >= this.maxRows) {
                    this.error = `Maximum of ${this.maxRows} rows allowed.`;
                    return;
                }
                this.state.push({ key: '', value: '' });
                this.clearError();
            },

            deleteRow: function(index) {
                if (this.state.length <= this.minRows) {
                    this.error = `Minimum of ${this.minRows} row(s) required.`;
                    return;
                }
                
                if (index >= 0 && index < this.state.length) {
                    this.state.splice(index, 1);
                    this.clearError();
                }
            },

            duplicateRow: function(index) {
                if (this.maxRows && this.state.length >= this.maxRows) {
                    this.error = `Maximum of ${this.maxRows} rows allowed.`;
                    return;
                }
                
                if (index >= 0 && index < this.state.length) {
                    const originalRow = this.state[index];
                    const originalKey = originalRow.key || '';
                    
                    // Generate unique key for duplicate
                    let newKey = originalKey;
                    if (originalKey.trim() !== '') {
                        let counter = 1;
                        do {
                            newKey = `${originalKey}_copy${counter > 1 ? counter : ''}`;
                            counter++;
                        } while (this.state.some(row => row.key === newKey));
                    }
                    
                    const newRow = { 
                        key: newKey, 
                        value: originalRow.value || '' 
                    };
                    
                    this.state.splice(index + 1, 0, newRow);
                    this.clearError();
                }
            },

            clearAll: function() {
                this.state = Array(this.minRows).fill().map(() => ({ key: '', value: '' }));
                this.clearError();
            },

            clearError: function() {
                this.error = '';
            },

            getRowCount: function() {
                return this.state.length;
            },

            isRowDuplicate: function(index) {
                if (!this.preventDuplicateKeys || !this.state[index]) return false;

                const currentKey = this.state[index].key ? this.state[index].key.trim() : '';
                
                if (currentKey === '') return false;
                
                return this.state.filter(row => {
                    const key = row.key ? row.key.trim() : '';
                    return key === currentKey;
                }).length > 1;
            },

            isRowValueEmpty: function(index) {
                if (this.allowEmptyValues || !this.state[index]) return false;
                
                const row = this.state[index];
                const key = row.key ? row.key.trim() : '';
                const value = row.value ? row.value.trim() : '';
                
                return key !== '' && value === '';
            },
            onDragStart: function(index) {
                this.dragIndex = index;
            },

            onDrop: function(dropIndex) {
                if (this.dragIndex === -1 || this.dragIndex === dropIndex) {
                    this.dragIndex = -1;
                    return;
                }

                const newState = [...this.state];
                const draggedItem = newState.splice(this.dragIndex, 1)[0];
                
                newState.splice(dropIndex, 0, draggedItem);

                this.state = newState;
                this.dragIndex = -1;
                this.clearError();
            },
            onDragEnd: function() {
                this.dragIndex = -1;
            }
        }
    }"
    {{ $attributes->class($classes) }}
>
    <div class="border border-black/10 dark:border-white/10 bg-white dark:bg-neutral-900 dark:text-neutral-50 text-neutral-900 rounded-box overflow-hidden">
        @if($showTopBar)
           <x-ui.key-value.top-bar/>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full table-fixed border-collapse ">
                <colgroup>
                    @if ($reorderable)
                        <col class="w-12">
                    @endif
                    <col class="w-1/2">
                    <col class="w-1/2">
                    <col class="max-w-24" data-col="actions">
                </colgroup>
                <thead class="bg-white dark:bg-neutral-900">
                    <tr>
                        @if ($reorderable)
                            <x-ui.key-value.th class="w-12">
                                <x-ui.icon name="arrows-up-down" class="size-4"/>
                            </x-ui.key-value.th>
                        @endif
                        <x-ui.key-value.th :label="$keyLabel"/>
                        <x-ui.key-value.th :label="$valueLabel"/>
                        <x-ui.key-value.th label="actions" class="w-24"/>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-900 divide-y divide-neutral-800/10 dark:divide-white/10">
                    <template x-for="(row, index) in state" :key="'row-' + index">
                        <tr 
                            class="transition-all duration-200"
                            x-bind:class="{
                                'opacity-50 scale-95': dragIndex === index
                            }"
                            @if($reorderable)
                                x-on:dragover.prevent
                                x-on:drop.prevent="onDrop(index)"
                                x-on:dragend="onDragEnd()"
                            @endif
                        >
                            @if ($reorderable)
                                <td class="px-3 py-2 text-center dark:border dark:border-white/10 border-0 w-12">
                                    <div 
                                        class=" cursor-grab active:cursor-grabbing rounded p-1 transition-colors"
                                        draggable="true"
                                        x-on:dragstart="onDragStart(index)"
                                    >
                                        <x-ui.icon name="bars-3" class="size-4 text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-200"/>
                                    </div>
                                </td>
                            @endif
                            
                            {{-- Key Input --}}
                            <td class="dark:border dark:border-white/10 border-0 p-0!">
                                <x-ui.key-value.input
                                    x-model="state[index].key"
                                    :placeHolder="$keyPlaceholder"
                                />
                            </td>
                            
                            {{-- Value Input --}}
                            <td class=" dark:border dark:border-white/10 border-0 p-0!">
                                <x-ui.key-value.input
                                    x-model="state[index].value"
                                    :placeHolder="$valuePlaceholder"
                                />
                            </td>

                            Individual Actions
                            <td class="p-2 dark:border dark:border-white/10 border-0 w-24">
                                <x-ui.key-value.actions/>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        {{-- Add Row Button --}}
        <div class="bg-white dark:bg-neutral-900 px-4 py-3 border-t border-neutral-800/10 dark:border-white/10">
            <div class="flex justify-between items-center">
                <x-ui.button
                    icon="plus"
                    x-on:click="addRow()"
                    x-bind:disabled="maxRows && state.length >= maxRows"
                >
                    {{ $addButtonText }}
                </x-ui.button>

                @if (filled($maxRows) || (filled($minRows) && $minRows > 1))
                    <div class="text-xs text-neutral-500 dark:text-neutral-400">
                        Min: {{ $minRows }} | Max: {{ $maxRows }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Error Messages --}}
    <div x-show="error" x-transition class="{{ $errorClass }}">
        <span x-text="error"></span>
    </div>

</div>