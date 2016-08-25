<?php namespace Anomaly\Streams\Platform\Database\Migration\Command;

use Anomaly\Streams\Platform\Database\Migration\Command\Migrate;

/**
 * Class MigrateHandler
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class MigrateHandler
{

    /**
     * Handle the command.
     *
     * @param Migrate $command
     */
    public function handle(Migrate $command)
    {
        $migration = $command->getMigration();

        $migration->createFields();
        $migration->createStream();
        $migration->assignFields();
    }
}
