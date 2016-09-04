<?php namespace Anomaly\Streams\Platform\Assignment\Command;

use Anomaly\Streams\Platform\Assignment\AssignmentSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;

/**
 * Class UpdateAssignmentColumn
 *
 * @link    http://anomaly.is/streams-platform
 * @author  AnomalyLabs, Inc. <hello@anomaly.is>
 * @author  Ryan Thompson <ryan@anomaly.is>
 */
class UpdateAssignmentColumn
{

    /**
     * The assignment interface.
     *
     * @var AssignmentInterface
     */
    protected $assignment;

    /**
     * Create a new UpdateAssignmentColumn instance.
     *
     * @param AssignmentInterface $assignment
     */
    public function __construct(AssignmentInterface $assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Handle the command.
     *
     * @param AssignmentSchema $schema
     */
    public function handle(AssignmentSchema $schema)
    {
        $stream = $this->assignment->getStream();
        $type   = $this->assignment->getFieldType();

        if (!$this->assignment->isTranslatable()) {
            $table = $stream->getEntryTableName();
        } else {
            $table = $stream->getEntryTranslationsTableName();
        }

        $schema->updateColumn($table, $type, $this->assignment);
    }
}
