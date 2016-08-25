<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class HeaderDefaults
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class HeaderDefaults
{

    /**
     * Set defaults.
     *
     * @param TableBuilder $builder
     */
    public function defaults(TableBuilder $builder)
    {
        $stream = $builder->getTableStream();

        if ($builder->getColumns() == []) {
            $builder->setColumns([$stream->getTitleColumn()]);
        }
    }
}
