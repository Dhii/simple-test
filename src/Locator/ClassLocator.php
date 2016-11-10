<?php

namespace Dhii\SimpleTest\Locator;

use Dhii\SimpleTest\Test;

/**
 * A default implementation of a class test locator.
 *
 * @since 0.1.0
 */
class ClassLocator extends AbstractClassLocator
{
    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     *
     * @return Test\Test
     */
    protected function _createTest($className, $methodName, $key)
    {
        return new Test\Test($className, $methodName, $key);
    }

    /**
     * Checks if the given method's name starts with "test".
     *
     * @since 0.1.0
     */
    protected function _matchMethod(\ReflectionMethod $method)
    {
        return $this->_stringStartsWith($method->getName(), 'test');
    }

    /**
     * Checks if the given string starts with the specified prefix.
     *
     * @since 0.1.0
     *
     * @param string $string         The string to check.
     * @param string $requiredPrefix The prefix.
     *
     * @return bool True if the string starts witht the required prefix;
     *              otherwise false.
     */
    protected function _stringStartsWith($string, $requiredPrefix)
    {
        $requiredLength = strlen($requiredPrefix);
        $prefix         = substr($string, 0, $requiredLength);

        return $prefix === $requiredPrefix;
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     *
     * @param array|\Traversable $items
     *
     * @return ResultSet The new result set.
     */
    protected function _createResultSet($items)
    {
        return new ResultSet($items);
    }
}
