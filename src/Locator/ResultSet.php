<?php

namespace Dhii\SimpleTest\Locator;

use Dhii\SimpleTest\Test;
use InvalidArgumentException;

/**
 * A default locator result set implementation.
 *
 * @since 0.1.0
 */
class ResultSet extends AbstractResultSet
{
    /**
     * @since 0.1.0
     *
     * @param Test\TestInterface[]|\Traversable $items The items for this set.
     */
    public function __construct($items)
    {
        $this->_construct();
        $this->_addItems($items);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    protected function _validateItem($item)
    {
        if (!($item instanceof Test\TestInterface)) {
            throw new InvalidArgumentException(sprintf('Not a valid test'));
        }
    }
}
