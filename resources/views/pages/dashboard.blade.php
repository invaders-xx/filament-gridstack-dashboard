@php
    use Filament\Support\Facades\FilamentAsset;
    use Filament\Widgets\WidgetConfiguration;
    $columns = $this->getColumns();
    $rows = $this->getRows();
    $float = $this->getFloat();
    $disableDrag = $this->getDisableDrag();
    $disableResize = $this->getDisableResize();
    $resizable = $this->getResizable();
@endphp

<x-filament-panels::page class="fi-dashboard-page">
    @if ($designMode)
        <div x-ignore
             ax-load
             ax-load-src="{{ FilamentAsset::getAlpineComponentSrc('filament-gridstack-dashboard-script', 'invaders-xx/filament-gridstack-dashboard') }}"
             x-data="gridStackDashboard({
                    columns:{{ $columns }},
                    rows: {{ $rows }},
                    float: {{ $float }},
                    disableResize: {{ $disableResize ? 1:0 }},
                    disableDrag: {{ $disableDrag ? 1:0 }},
                    resizable: '{{ $resizable }}'
                    })"
             x-load-css="[@js(FilamentAsset::getStyleHref('filament-gridstack-dashboard-styles', package: 'invaders-xx/filament-gridstack-dashboard'))]"
             class="text-center"
        >
            <div class="flex w-full flex-row items-start space-x-3 p-3">
                <x-filament::button wire:click="saveLayout">
                    {{ __('filament-gridstack-dashboard::component.actions.save') }}
                </x-filament::button>
                <x-filament::button wire:click="cancelLayout" color="gray">
                    {{ __('filament-gridstack-dashboard::component.actions.cancel') }}
                </x-filament::button>
                <x-filament::button @click="removeAll()" color="danger">
                    {{ __('filament-gridstack-dashboard::component.actions.remove_all') }}
                </x-filament::button>
            </div>
            <div class="mx-auto grid w-full grid-cols-12 space-x-3">
                <div class="col-span-3 md:mb-10">
                    <div class="mb-4 mt-4 bg-gray-500 dark:bg-white"></div>
                    <div
                            id="trash"
                            class="border-danger-500 bg-danger-500 flex items-center border p-6 text-center"
                    >
                        <x-heroicon-o-trash class="mr-2 h-8 w-8 text-white"/>
                        <span class="text-white">{{ __('filament-gridstack-dashboard::component.trash_zone') }}</span>
                    </div>
                    <div class="mb-4 mt-4 bg-gray-500 dark:bg-white"></div>
                    <x-filament::section collapsible>
                        <x-slot name="heading">{{ __('filament-gridstack-dashboard::component.widgets') }}</x-slot>
                        <div class="flex flex-col items-stretch space-y-3">
                            @foreach ($this->getFilteredWidgets() as $class => $label)
                                <x-filament::button
                                        color="gray"
                                        @click="addItem('{{ addslashes($class) }}', '{{ addslashes($label) }}')"
                                >
                                    {{ $label }}
                                </x-filament::button>
                            @endforeach
                        </div>
                        <hr class="mb-4 mt-4 bg-gray-500 dark:bg-gray-700"/>
                        <div class="space-x-3">
                            <x-filament::button wire:click="saveLayout">
                                {{ __('filament-gridstack-dashboard::component.actions.save') }}
                            </x-filament::button>
                            <x-filament::button wire:click="cancelLayout" color="gray">
                                {{ __('filament-gridstack-dashboard::component.actions.cancel') }}
                            </x-filament::button>
                            <x-filament::button @click="removeAll" color="danger">
                                {{ __('filament-gridstack-dashboard::component.actions.remove_all') }}
                            </x-filament::button>
                        </div>
                    </x-filament::section>
                </div>

                <div wire:ignore class="col-span-9 bg-gray-50 dark:bg-gray-900">
                    <x-filament::section>
                        <x-slot name="heading">{{ __('filament-gridstack-dashboard::component.layout') }}</x-slot>
                        <div class="grid-stack min-h-screen"></div>
                    </x-filament::section>
                </div>
            </div>
        </div>
    @else
        @php
            $normalizeWidgetClass = function (string|WidgetConfiguration $widget): string {
                if ($widget instanceof WidgetConfiguration) {
                    return $widget->widget;
                }

                return $widget;
            };
            $data = [...property_exists($this, 'filters') ? ['filters' => $this->filters] : [], ...$this->getWidgetData()];
        @endphp
        @if (method_exists($this, 'filtersForm'))
            {{ $this->filtersForm }}
        @endif
        <div class="fi-wi flex flex-col gap-6">
            @foreach ($this->buildGridItemsForDesign() as $row => $widgets)
                <x-filament::grid :default="$columns" class="gap-6">
                    @foreach ($widgets as $widgetKey => $widget)
                        @if($widget['id']===null)
                            <x-filament::grid.column
                                    class="fi-wi-widget"
                                    :default="$widget['w']">
                            </x-filament::grid.column>
                        @else
                            @php
                                $widgetClass = $normalizeWidgetClass($widget['id']);
                            @endphp
                            <x-filament::grid.column
                                    class="fi-wi-widget"
                                    :default="$widget['w']">
                                @livewire($widgetClass,
                                [...$widget['id'] instanceof \Filament\Widgets\WidgetConfiguration?
                                [...$widget['id']->widget::getDefaultProperties(), ...$widget['id']->getProperties()]:
                                $widget['id']::getDefaultProperties(),...$data,],
                                key("{$widgetClass}-{$widgetKey}")
                                )
                            </x-filament::grid.column>
                        @endif
                    @endforeach
                </x-filament::grid>
            @endforeach
        </div>
    @endif
</x-filament-panels::page>