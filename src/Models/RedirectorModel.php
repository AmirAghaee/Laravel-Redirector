<?php

namespace AmirAghaee\Redirector\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * AmirAghaee\Redirector\Models\RedirectorModel
 *
 * @property int $status
 * @property string $source
 * @property string|null $endpoint
 * @method static Builder|RedirectorModel newModelQuery()
 * @method static Builder|RedirectorModel where($column, $condition)
 * @method static Builder|RedirectorModel all()
 * @method static Builder|RedirectorModel get()
 * @method static create(array $values)
 * @method static truncate()
 * @method static bool exist()
 */
class RedirectorModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'redirector';

    /**
     * fillable column
     *
     * @var array
     */
    protected $fillable = ['source', 'endpoint', 'status'];

    /**
     * Disable Laravel auto timestamp
     *
     * @var bool
     */
    public $timestamps = false;
}
