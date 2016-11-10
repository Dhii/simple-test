<?php

namespace Dhii\SimpleTest\Locator;

/**
 * A default implementation of a file path locator.
 *
 * Uses all the default implementations of dependencies.
 *
 * @since 0.1.0
 */
class FilePathLocator extends AbstractFilePathLocator
{
    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
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
     * @since 0.1.0
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
     * @since 0.1.0
     */
    protected function _matchFile($file)
    {
        $file = $this->_basename($file);

        return $this->_endsWith($file, 'Test');
    }
}
