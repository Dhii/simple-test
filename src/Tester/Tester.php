<?php

namespace Dhii\SimpleTest\Tester;

use Dhii\SimpleTest\Coordinator;
use Dhii\SimpleTest\Runner;
use Dhii\SimpleTest\Suite;
use Dhii\SimpleTest\Assertion;
use Dhii\SimpleTest\Writer;
use Dhii\Collection;
use Dhii\SimpleTest\Test;
use Dhii\Stats;

/**
 * A default tester implementation.
 *
 * @since 0.1.0
 */
class Tester extends AbstractStatefulTester implements Suite\FactoryInterface
{
    /**
     * @param Writer\WriterInterface A writer for this tester to use.
     *  If none given, will create a default writer instance.
     *
     * @since 0.1.0
     *
     * @param Writer\WriterInterface $writer The writer to assign to this instance.
     */
    public function __construct(Writer\WriterInterface $writer = null)
    {
        if (!is_null($writer)) {
            $this->_setWriter($writer);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    public function createSuite($code)
    {
        return $this->_createSuite($code, $this->_getCoordinatorInstance());
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createWriter()
    {
        return new Writer\Writer();
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createAssertionMaker()
    {
        return new Assertion\Maker();
    }

    /**
     * Prepares a result set from an array of results.
     *
     * @since 0.1.0
     *
     * @param Test\ResultInterface[]|\Traversable $results A traversible list of result sets.
     *
     * @return Test\ResultSetInterface The list of result sets.
     */
    protected function _prepareResults($results)
    {
        return $this->_createResultSetIterator($results, $this->_getStatAggregatorInstance());
    }

    /**
     * Creates a new instance of a result set collection.
     *
     * @since 0.1.0
     *
     * @param Test\ResultInterface[]|\Traversable $results A traversible list of result sets.
     * @param Stats\AggregatorInterface The stat aggregator for the new iterator.
     *
     * @return Collection\SequenceIteratorIteratorInterface|Test\ResultSetInterface The list of result sets.
     */
    protected function _createResultSetIterator($results, Stats\AggregatorInterface $aggregator = null)
    {
        $iterator = new Test\ResultSetCollection($results, $aggregator);

        return $iterator;
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createSuite($code, Coordinator\CoordinatorInterface $coordinator)
    {
        return new Suite\Suite($code, $coordinator);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createStatAggregator()
    {
        return new Test\Aggregator();
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createCoordinator(Writer\WriterInterface $writer)
    {
        return new Coordinator\Coordinator($writer);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createRunner(Coordinator\CoordinatorInterface $coordinator, Assertion\MakerInterface $assertionMaker, Stats\AggregatorInterface $statAggregator)
    {
        return new Runner\Runner($coordinator, $assertionMaker, $statAggregator);
    }
}
