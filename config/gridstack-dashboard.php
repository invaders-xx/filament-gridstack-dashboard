<?php

use App\Filament\App\Widgets\ApprovedQuotes;
use App\Filament\App\Widgets\BalanceChart;
use App\Filament\App\Widgets\BrutoMarginChart;
use App\Filament\App\Widgets\PaymentRemindersTableWidget;
use App\Filament\App\Widgets\RunningProjectsChart;
use Bouwflow\Crm\Filament\Crm\Widgets\FollowUpTableWidget;

return [
    'should_register_navigation' => true,
    'navigation_sort' => -5,
    'navigation_group' => 'Algemeen',

    'allowed_widgets' => [
        RunningProjectsChart::class,
        BrutoMarginChart::class,
        ApprovedQuotes::class,
        FollowUpTableWidget::class,
        PaymentRemindersTableWidget::class,
    ],

    'empty_state_widgets' => [
        "widget" => RunningProjectsChart::class,
        "x" => 0,
        "y" => 0,
        "w" => 6,
    ],
    [
        "widget" => BrutoMarginChart::class,
        "x" => 6,
        "y" => 0,
        "w" => 6,
    ],

    [
        "widget" => ApprovedQuotes::class,
        "x" => 0,
        "y" => 1,
        "w" => 12,
    ],
    [
        "widget" => FollowUpTableWidget::class,
        "x" => 0,
        "y" => 2,
        "w" => 12,
    ],
    [
        "widget" => PaymentRemindersTableWidget::class,
        "x" => 0,
        "y" => 3,
        "w" => 12,
    ]
];
