<?php namespace Anomaly\Streams\Platform\Application;

use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class ApplicationModel
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 */
class ApplicationModel extends EloquentModel
{

    /**
     * No timestamps right now.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The connection to use.
     *
     * @var string
     */
    protected $connection = 'core';

    /**
     * The model table.
     *
     * @var string
     */
    protected $table = 'applications';

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'domain',
        'enabled',
        'reference',
    ];
}
