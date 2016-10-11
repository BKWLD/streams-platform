<?php namespace Anomaly\Streams\Platform\Stream;

use Anomaly\Streams\Platform\Search\Command\CheckEntryIndex;
use Anomaly\Streams\Platform\Search\Command\DeleteEntryIndex;
use Anomaly\Streams\Platform\Stream\Command\CreateStreamsEntryTable;
use Anomaly\Streams\Platform\Stream\Command\DeleteStreamAssignments;
use Anomaly\Streams\Platform\Stream\Command\DeleteStreamEntryModels;
use Anomaly\Streams\Platform\Stream\Command\DeleteStreamTranslations;
use Anomaly\Streams\Platform\Stream\Command\DropStreamsEntryTable;
use Anomaly\Streams\Platform\Stream\Command\RenameAssociatedPivotTables;
use Anomaly\Streams\Platform\Stream\Command\RenameStreamsEntryTable;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Event\StreamWasCreated;
use Anomaly\Streams\Platform\Stream\Event\StreamWasDeleted;
use Anomaly\Streams\Platform\Stream\Event\StreamWasSaved;
use Anomaly\Streams\Platform\Stream\Event\StreamWasUpdated;
use Anomaly\Streams\Platform\Stream\Event\StreamWasUpdating;
use Anomaly\Streams\Platform\Support\Observer;

/**
 * Class StreamObserver
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 */
class StreamObserver extends Observer
{

    /**
     * Run after stream a record.
     *
     * @param StreamInterface $model
     */
    public function saved(StreamInterface $model)
    {
        $model->compile();
        $model->flushCache();

        $this->dispatch(new CheckEntryIndex($model));

        $this->events->fire(new StreamWasSaved($model));
    }

    /**
     * Run after a stream is created.
     *
     * @param StreamInterface $model
     */
    public function created(StreamInterface $model)
    {
        $model->compile();
        $model->flushCache();

        $this->dispatch(new CreateStreamsEntryTable($model));

        $this->events->fire(new StreamWasCreated($model));
    }

    /**
     * Run before a record is updated.
     *
     * @param StreamInterface $model
     */
    public function updating(StreamInterface $model)
    {
        $this->dispatch(new RenameStreamsEntryTable($model));

        $this->dispatch(new StreamWasUpdating($model));
    }

    /**
     * Run after a record is updated.
     *
     * @param StreamInterface $model
     */
    public function updated(StreamInterface $model)
    {
        $this->dispatch(new StreamWasUpdated($model));
    }

    /**
     * Run after a stream has been deleted.
     *
     * @param StreamInterface $model
     */
    public function deleted(StreamInterface $model)
    {
        $model->compile();
        $model->flushCache();

        $this->dispatch(new DeleteEntryIndex($model));
        $this->dispatch(new DropStreamsEntryTable($model));
        $this->dispatch(new DeleteStreamEntryModels($model));
        $this->dispatch(new DeleteStreamAssignments($model));
        $this->dispatch(new DeleteStreamTranslations($model));

        $this->events->fire(new StreamWasDeleted($model));
    }
}
