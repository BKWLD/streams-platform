<?php namespace Anomaly\Streams\Platform\Addon\Extension\Console;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionManager;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Install
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class Install extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'extension:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install a extension.';

    /**
     * Execute the console command.
     *
     * @param ExtensionManager    $manager
     * @param ExtensionCollection $extensions
     */
    public function fire(ExtensionManager $manager, ExtensionCollection $extensions)
    {
        /* @var Extension $extension */
        $extension = $extensions->get($this->argument('extension'));

        $manager->install($extension, $this->option('seed'));

        $this->info(trans($extension->getName()) . ' installed successfully!');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['extension', InputArgument::REQUIRED, 'The extension\'s dot namespace.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['seed', null, InputOption::VALUE_NONE, 'Seed the extension after installing?'],
        ];
    }
}
