<?php namespace Anomaly\Streams\Platform\Installer\Console\Command;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Installer\Installer;
use Anomaly\Streams\Platform\Installer\InstallerCollection;
use Illuminate\Contracts\Console\Kernel;


/**
 * Class LoadExtensionSeeders
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Installer\Console\Command
 */
class LoadExtensionSeeders
{

    /**
     * The installer collection.
     *
     * @var InstallerCollection
     */
    protected $installers;

    /**
     * Create a new LoadExtensionSeeders instance.
     *
     * @param InstallerCollection $installers
     */
    public function __construct(InstallerCollection $installers)
    {
        $this->installers = $installers;
    }

    /**
     * Handle the command.
     *
     * @param ExtensionCollection $extensions
     */
    public function handle(ExtensionCollection $extensions)
    {
        /* @var Extension $extension */
        foreach ($extensions as $extension) {
            $this->installers->add(
                new Installer(
                    trans('streams::installer.seeding', ['seeding' => trans($extension->getName())]),
                    function (Kernel $console) use ($extension) {
                        $console->call(
                            'db:seed',
                            [
                                '--addon' => $extension->getNamespace(),
                                '--force' => true
                            ]
                        );
                    }
                )
            );
        }
    }
}
