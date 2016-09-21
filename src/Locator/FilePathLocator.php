<?php

namespace Dhii\SimpleTest\Locator;

/**
 * A default implementation of a file path locator.
 *
 * Uses all the default implementations of dependencies.
 *
 * @since [*next-version*]
 */
class FilePathLocator extends AbstractFilePathLocator
{
    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     *
     * @return ClassLocator
     */
    protected function _createClassLocator($className)
    {
        $locator = new ClassLocator();
        $locator->setClass($className);

        return $locator;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     *
     * @return ResultSet
     */
    protected function _createResultSet($items)
    {
        return new ResultSet($items);
    }

    /**
     * Whether or not the extension-less basename of the file path ends with "Test".
     *
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _matchFile($file)
    {
        $file = $this->_basename($file);

        return $this->_endsWith($file, 'Test');
    }
}
