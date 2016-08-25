<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Query;

use Anomaly\Streams\Platform\Model\EloquentQueryBuilder;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\SearchFilterInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SearchFilterQuery
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Ui\Table\Component\Filter\Handler
 */
class SearchFilterQuery
{

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new FieldFilterQuery instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Handle the filter.
     *
     * @param Builder               $query
     * @param SearchFilterInterface $filter
     */
    public function handle(Builder $query, TableBuilder $builder, SearchFilterInterface $filter)
    {
        $stream = $filter->getStream();
        $model  = $builder->getTableModel();

        /**
         * If the model is translatable then
         * join it's translations so they
         * are filterable too.
         *
         * @var EloquentQueryBuilder $query
         */
        if ($model->getTranslationModelName() && !$query->hasJoin($model->getTranslationTableName())) {
            $query->leftJoin(
                $model->getTranslationTableName(),
                $model->getTableName() . '.id',
                '=',
                $model->getTranslationTableName() . '.' . $model->getRelationKey()
            );
        }

        $query->where(
            function (Builder $query) use ($filter, $stream) {

                foreach ($filter->getColumns() as $column) {
                    $query->orWhere($column, 'LIKE', "%{$filter->getValue()}%");
                }

                foreach ($filter->getFields() as $field) {

                    $filter->setField($field);

                    $fieldType      = $stream->getFieldType($field);
                    $fieldTypeQuery = $fieldType->getQuery();

                    $fieldTypeQuery->setConstraint('or');

                    $this->container->call([$fieldTypeQuery, 'filter'], compact('query', 'filter', 'builder'));
                }
            }
        );
    }
}
