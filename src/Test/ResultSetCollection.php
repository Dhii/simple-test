<?php

namespace Dhii\SimpleTest\Test;

use UnexpectedValueException;
use Dhii\Stats;

/**
 * An implementation of a result set that abstracts access to
 * multiple result sets.
 *
 * @since 0.1.0
 */
class ResultSetCollection extends AbstractResultSetCollection
{
    /**
     * @since 0.1.0
     *
     * @param ResultSetInterface[]|\Traversable $items          A list of test result sets.
     * @param Stats\AggregatorInterface         $statAggregator The stat aggregator to be used by this instance.
     */
    public function __construct($items, Stats\AggregatorInterface $statAggregator)
    {
        $this->_addItems($items);
        $this->_setStatAggregator($statAggregator);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createInnerIterator()
    {
        return new \AppendIterator();
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _validateItem($item)
    {
        if (!($item instanceof ResultSetInterface)) {
            throw new UnexpectedValueException(sprintf('Item must be a valid test result set'));
        }
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createSearchResultsIterator($results)
    {
        $class    = 'Dhii\SimpleTest\Test\ResultSet';
        $instance = new $class(array(), $this->_getStatAggregator());
        /* @var $instance AbstractSearchableCollection */
        $instance->_setItems($results);

        return $instance;
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _isValidSearchResult($item)
    {
        return $item instanceof ResultInterface;
    }
}
