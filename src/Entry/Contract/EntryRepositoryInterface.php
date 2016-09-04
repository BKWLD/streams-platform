<?php namespace Anomaly\Streams\Platform\Entry\Contract;

use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;

/**
 * Interface EntryRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
interface EntryRepositoryInterface extends EloquentRepositoryInterface
{

    /**
     * Get the entries by sort order.
     *
     * @param  string                 $direction
     * @return EntryCollection|static
     */
    public function sorted($direction = 'asc');

    /**
     * Get the first entry
     * by it's sort order.
     *
     * @param  string              $direction
     * @return EntryInterface|null
     */
    public function first($direction = 'asc');

    /**
     * Return the last modified entry.
     *
     * @return EntryInterface|null
     */
    public function lastModified();
}
