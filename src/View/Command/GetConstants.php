<?php namespace Anomaly\Streams\Platform\View\Command;

use Illuminate\Contracts\View\Factory;

/**
 * Class GetConstants
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class GetConstants
{

    /**
     * Handle the command.
     *
     * @param  Factory                         $view
     * @return \Illuminate\Contracts\View\View
     */
    public function handle(Factory $view)
    {
        return $view->make('streams::partials/constants');
    }
}
