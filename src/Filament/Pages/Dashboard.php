<?php

namespace InvadersXX\FilamentGridstackDashboard\Filament\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\TableWidget;
use Filament\Widgets\Widget;
use Illuminate\Contracts\Support\Htmlable;
use InvadersXX\FilamentGridstackDashboard\GridstackDashboardPlugin;

class Dashboard extends BaseDashboard
{
    public bool $designMode = false;

    public array $gridItems = [];

    protected static string $view = 'filament-gridstack-dashboard::pages.dashboard';

    public static function getNavigationGroup(): ?string
    {
        return GridstackDashboardPlugin::get()->getNavigationGroup() ?? parent::getNavigationGroup();
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return GridstackDashboardPlugin::get()->getNavigationIcon() ?? parent::getNavigationIcon();
    }

    public static function getNavigationSort(): ?int
    {
        return GridstackDashboardPlugin::get()->getNavigationSort() ?? parent::getNavigationSort();
    }

    public function getColumns(): int
    {
        return GridstackDashboardPlugin::get()->getColumns() ?? 12;
    }

    public function saveLayout(): void
    {
        $data = collect($this->gridItems)->sortBy([
            ['y', 'asc'],
            ['x', 'asc'],
        ])->values()->mapWithKeys(fn ($item, $key) => [$key => [
            'widget' => $item['id'],
            'label' => $item['content'],
            'x' => $item['x'],
            'y' => $item['y'],
            'w' => $item['w'],
        ]])->all();
        auth()->user()->settings()->set(static::getSettingsPath(), $data);
        $this->designMode = false;
        Notification::make()->success()->title(__('filament-gridstack-dashboard::component.notifications.success'))->body(__('filament-gridstack-dashboard::component.notifications.saved'))->send();
    }

    public function cancelLayout(): void
    {
        $this->designMode = false;
    }

    public function getFilteredWidgets(): array
    {
        $return = [];
        foreach ($this->getVisibleWidgets() as $widgetClass) {
            $widgetInstance = app()->make($widgetClass);

            $label = match (true) {
                $widgetInstance instanceof TableWidget => (string) invade($widgetInstance)->makeTable()->getHeading(),
                ! ($widgetInstance instanceof TableWidget) && $widgetInstance instanceof Widget && method_exists(
                    $widgetInstance,
                    'getHeading'
                ) => (string) invade($widgetInstance)->getHeading(),
                default => str($widgetClass)
                    ->afterLast('\\')
                    ->headline()
                    ->toString()
            };
            $return[$widgetClass] = $label;
        }

        return $return;
    }

    public function buildGridItemsForDesign(): array
    {
        $return = [];
        $this->gridItems = [];
        foreach ($this->getVisibleWidgetsForGrid() as $widget) {
            $widgetInstance = app()->make($widget['widget']);

            $label = match (true) {
                $widgetInstance instanceof TableWidget => (string) invade($widgetInstance)->makeTable()->getHeading(),
                ! ($widgetInstance instanceof TableWidget) && $widgetInstance instanceof Widget && method_exists(
                    $widgetInstance,
                    'getHeading'
                ) => (string) invade($widgetInstance)->getHeading(),
                default => str($widget['widget'])
                    ->afterLast('\\')
                    ->headline()
                    ->toString()
            };
            $item['id'] = $widget['widget'];
            $item['w'] = $widget['w'];
            $item['x'] = $widget['x'];
            $item['y'] = $widget['y'];
            $item['content'] = $label;
            $item['resizeHandles'] = 'e,w';
            if (! isset($return[$item['y']])) {
                $return[$item['y']] = [];
            }
            $return[$item['y']][] = $item;
            $this->gridItems[] = $item;
        }

        return $return;
    }

    protected static function getSettingsPath(): string
    {
        return GridstackDashboardPlugin::get()->getSettingsPath();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('layout')
                ->label(__('filament-gridstack-dashboard::component.layout'))
                ->tooltip(__('filament-gridstack-dashboard::component.layout'))
                ->icon('heroicon-o-rectangle-group')
                ->color('gray')
                ->action(function () {
                    $this->designMode = ! $this->designMode;
                    if ($this->designMode) {
                        $this->buildGridItemsForDesign();
                    }
                }),
        ];
    }

    protected function getVisibleWidgetsForGrid(): array
    {
        return auth()->user()->settings()->get(static::getSettingsPath(), GridstackDashboardPlugin::get()->getDefaultGrid());
    }
}
