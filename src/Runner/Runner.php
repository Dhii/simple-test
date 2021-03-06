<?php

namespace Dhii\SimpleTest\Runner;

use Dhii\Stats;
use Dhii\SimpleTest\Test;
use Dhii\SimpleTest\Coordinator;
use Dhii\SimpleTest\Assertion;

/**
 * A default runner implementation.
 *
 * @since 0.1.0
 */
class Runner extends AbstractRunner
{
    /**
     * @since 0.1.0
     *
     * @param Coordinator\CoordinatorInterface $coordinator    The coordinator that this runner will notify.
     * @param Assertion\MakerInterface         $assertionMaker The assertion maker that test cases run by this runner will use.
     */
    public function __construct(
            Coordinator\CoordinatorInterface $coordinator,
            Assertion\MakerInterface $assertionMaker,
            Stats\AggregatorInterface $statAggregator)
    {
        $this->_setCoordinator($coordinator);
        $this->_setAssertionMaker($assertionMaker);
        $this->_setStatAggregator($statAggregator);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    public function getCode()
    {
        return 'default';
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createResultFromTest(Test\TestBaseInterface $test, $message, $status, $assertionCount, $runnerCode, $time, $memory)
    {
        return new Test\Result(
                $test->getCaseName(),
                $test->getMethodName(),
                $test->getKey(),
                $message,
                $status,
                $assertionCount,
                $test->getSuiteCode(),
                $runnerCode,
                $time,
                $memory);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _createResultSet($results)
    {
        return new Test\ResultSet($results, $this->_getStatAggregator());
    }
}
