<?php

namespace InvadersXX\FilamentGridstackDashboard\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GridStackDashboard extends Model
{
    protected $table = 'grid_stack_dashboard';

    protected $fillable = [
        'user_id',
        'parameters',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'parameters' => 'array',
    ];

    public function getTable()
    {
        return config('gridstack-dashboard.table', 'filament_gridstack_dashboards');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('gridstack-dashboard.users.model', User::class));
    }

    public function belongsToCurrentUser(): bool
    {
        return auth()->id() === $this->user_id;
    }
}
