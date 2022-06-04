<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'field_manager_id',
        'assigned_volunteers',
        'execution_date',
        'mission_status',
        'description',
        'procurement_items',
    ];

    public static $status = [
        'PRE_PLANNING' => 0,
        'NOT_STARTED' => 1,
        'IN_PROGRESS' => 2,
        'COMPLETED' => 3,
        'DISCREPENCIES' => 4,
    ];

    /**
     * location
     *
     * @return BelongsTo
     */
    public function location() : BelongsTo {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    /**
     * field_manager
     *
     * @return BelongsTo
     */
    public function field_manager() : BelongsTo {
        return $this->belongsTo(User::class, 'field_manager_id', 'id');
    }

    /**
     * volunteers
     *
     * @return HasMany
     */
    public function volunteers() : array {

        $volunteers = array();
        $mission_assignments = MissionAssignment::where('mission_id', $this->id);
        $volunteers['total'] = $mission_assignments->count();

        foreach($mission_assignments->get() as $volunteer) {
            $volunteers[$volunteer->user_id] = User::find($volunteer->user_id)->select('name', 'email')->first();
        }

        return $volunteers;
    }

    public $casts = [
        'execution_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];












}
