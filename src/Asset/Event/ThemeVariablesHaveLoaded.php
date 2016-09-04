<?php namespace Anomaly\Streams\Platform\Asset\Event;

use Anomaly\Streams\Platform\Support\Collection;

/**
 * Class ThemeVariablesHaveLoaded
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class ThemeVariablesHaveLoaded
{

    /**
     * The theme variables.
     *
     * @var Collection
     */
    protected $variables;

    /**
     * Create a new ThemeVariablesHaveLoaded instance.
     *
     * @param Collection $variables
     */
    public function __construct(Collection $variables)
    {
        $this->variables = $variables;
    }

    /**
     * Get the variables.
     *
     * @return Collection
     */
    public function getVariables()
    {
        return $this->variables;
    }
}
