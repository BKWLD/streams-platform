<?php namespace Anomaly\Streams\Platform\Support;

/**
 * Class Hydrator
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Support
 */
class Hydrator
{

    /**
     * Hydrate an object with parameters.
     *
     * @param       $object
     * @param array $parameters
     * @return mixed
     */
    public function hydrate($object, array $parameters)
    {
        foreach ($parameters as $parameter => $value) {

            $method = camel_case('set_' . $parameter);

            if (method_exists($object, $method)) {
                $object->{$method}($value);
            }
        }

        return $object;
    }
}
