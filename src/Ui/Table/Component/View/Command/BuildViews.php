<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Command;

use Anomaly\Streams\Platform\Ui\Table\Component\View\ViewBuilder;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
;

/**
 * Class BuildViews
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Table\Component\View\Command
 */
class BuildViews
{

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new BuildViews instance.
     *
     * @param TableBuilder $builder
     */
    public function __construct(TableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ViewBuilder $builder
     */
    public function handle(ViewBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
