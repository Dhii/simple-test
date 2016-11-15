<?php

namespace Dhii\SimpleTest\FuncTest\Tester\Locator;

/**
 * Tests {@see Dhii\SimpleTest\Locator\FilePathLocator}
 *
 * @since [*next-version*]
 */
class FilePathLocatorTest extends \Xpmock\TestCase
{
    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return \Dhii\SimpleTest\Locator\FilePathLocator
     */
    public function createSubject()
    {
        $mock = $this->mock('Dhii\\SimpleTest\\Locator\\FilePathLocator')
                ->new();

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createSubject();

        $this->assertInstanceOf('Dhii\\SimpleTest\\Locator\\FilePathLocatorInterface', $subject, 'Subject is not a valid file path locator');
    }

    /**
     * Tests whether the correct tests will be located in multiple files.
     *
     * @since [*next-version*]
     */
    public function testLocate()
    {
        $subject = $this->createSubject();

        // The 'stub' directory
        $testsRoot = dirname(dirname(dirname(__DIR__))) . '/stub';
        $subject->addPath(new \RecursiveDirectoryIterator($testsRoot));

        $tests = iterator_to_array($subject->locate());
        $this->assertCount(12, $tests, 'Subject failed to locate correct number of tests');
    }
}
