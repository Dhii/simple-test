<?php

namespace Dhii\SimpleTest\Test;

/**
 * A default test implementation.
 *
 * @since 0.1.0
 */
class Test extends AbstractTest
{
    /**
     * @since 0.1.0
     *
     * @param string $caseName   Name of the test case class for this test.
     * @param string $methodName Name of the test method.
     * @param string $key        The case-wide unique test identifier.
     */
    public function __construct($caseName, $methodName, $key)
    {
        $this->_setCaseName($caseName)
                ->_setMethodName($methodName)
                ->_setKey($key);
    }
}
