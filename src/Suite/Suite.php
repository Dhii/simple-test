<?php

namespace Dhii\SimpleTest\Suite;

use Dhii\SimpleTest\Runner;
use Dhii\SimpleTest\Coordinator;

/**
 * A default test suite implementation.
 *
 * @since 0.1.0
 */
class Suite extends AbstractSuite
{
    /**
     * @since 0.1.0
     *
     * @param string                           $code        This suite's unique code.
     * @param Runner\RunnerInterface           $runner      The runner that will run this suite's tests.
     * @param Coordinator\CoordinatorInterface $coordinator The coordinator to be used by this instance.
     */
    public function __construct($code, Coordinator\CoordinatorInterface $coordinator)
    {
        $this->_construct();

        $this->_setCode($code)
                ->_setCoordinator($coordinator);
    }
}
