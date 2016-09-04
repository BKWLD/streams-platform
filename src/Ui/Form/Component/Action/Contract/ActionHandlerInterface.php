<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action\Contract;

use Anomaly\Streams\Platform\Ui\Form\Form;

/**
 * Interface ActionHandlerInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
interface ActionHandlerInterface
{

    /**
     * Handle the form response.
     *
     * @param Form $form
     */
    public function handle(Form $form);
}
