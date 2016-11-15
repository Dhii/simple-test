<?php

namespace Dhii\SimpleTest\FuncTest\Tester\Test;

/**
 * Tests {@see Dhii\SimpleTest\Tester\Tester}
 * 
 * @since 0.1.0
 */
class TesterTest extends \Xpmock\TestCase
{
    protected $coordinator;
    
    /**
     * Creates a new instance of the test subject.
     * 
     * @since 0.1.0
     * 
     * @return \Dhii\SimpleTest\Tester\Tester
     */
    public function createSubject()
    {
        $mock = $this->mock('Dhii\SimpleTest\Tester\Tester')
                ->new();
        
        return $mock;
    }
    
    /**
     * Creates a new class locator.
     * 
     * @since 0.1.0
     * 
     * @return \Dhii\SimpleTest\Locator\ClassLocator The new class locator instance.
     */
    public function createClassLocator()
    {
        $instance = new \Dhii\SimpleTest\Locator\ClassLocator();
        
        return $instance;
    }
    
    /**
     * Creates a new test suite.
     * 
     * @since 0.1.0
     * 
     * @param \Dhii\SimpleTest\Test\TestInterface[] $tests An array of tests to include in the suite.
     * 
     * @return \Dhii\SimpleTest\Suite\DefaultSuite The new test suite instance.
     */
//    public function createSuite($tests)
//    {
//        $instance = new \Dhii\SimpleTest\Suite\DefaultSuite(uniqid('test-suite-'), $this->createCoordinator());
//        $instance->addTests($tests);
//        
//        return $instance;
//    }
    
    /**
     * Creates a new coordinator.
     * 
     * @since 0.1.0
     * 
     * @return \Dhii\SimpleTest\Coordinator\DefaultCoordinator The new coordinator instance.
     */
//    public function createCoordinator()
//    {
//        $instance = new \Dhii\SimpleTest\Coordinator\DefaultCoordinator();
//        
//        return $instance;
//    }
    
    
    /**
     * Tests whether a valid instance of the test subject can be created.
     * 
     * @since 0.1.0
     */
    public function testCanBeCreated()
    {
        $subject = $this->createSubject();
        
        $this->assertInstanceOf('Dhii\SimpleTest\Tester\TesterInterface', $subject, 'Subject is not a valid tester');
        $this->assertInstanceOf('Dhii\SimpleTest\Suite\FactoryInterface', $subject, 'Subject is not a valid suite factory');
    }
    
    /**
     * Tests whether the correct actions are taken if nothing to test.
     * 
     * All dependencies implicit.
     * 
     * @since 0.1.0
     */
    public function testRunAllEmpty()
    {
        $subject = $this->createSubject();
        
        ob_start();
        $subject->runAll();
        $output = ob_get_clean();
        
        $this->assertContains('No tests were ran', $output, 'Running empty tests did not produce a notice');
    }
    
    /**
     * Tests whether the result of the main functionality complies with package standards.
     * 
     * All dependencies implicit.
     * 
     * @since 0.1.0
     */
    public function testRunAllResultType()
    {
        $subject = $this->createSubject();
        
        $locator = $this->createClassLocator();
        $locator->setClass('Dhii\\SimpleTest\\Test\\Stub\\MyTestCaseTest');
        $suite = $subject->createSuite(uniqid('test-suite'));
        $suite->addTests($locator->locate());
        $subject->addSuite($suite);
        
        ob_start();
        $result = $subject->runAll();
        $output = ob_get_clean();
        
        $this->assertInstanceOf('Dhii\\SimpleTest\\Test\\ResultSetInterface', $result, 'Result is not a valid result set');
        $this->assertInstanceOf('Countable', $result, 'Result is not a valid countable');
        $this->assertInstanceOf('Dhii\\SimpleTest\\Test\\AccountableInterface', $result, 'Result is not a valid test accountable');
        $this->assertInstanceOf('Dhii\\SimpleTest\\Test\\UsageAccountableInterface', $result, 'Result is not a valid usage accountable');
        $this->assertInstanceOf('Dhii\\SimpleTest\\Assertion\\AccountableInterface', $result, 'Result is not a valid assertion accountable');
        $this->assertInstanceOf('Dhii\\Collection\\SearchableCollectionInterface', $result, 'Result is not a valid searchable collection');
        $this->assertInstanceOf('Dhii\\Collection\\CallbackIterableInterface', $result, 'Result is not a valid callback iterable');
    }
    
    /**
     * Tests whether the result of the main functionality works correctly.
     * 
     * All dependencies implicit.
     * 
     * @since 0.1.0
     */
    public function testRunAllResultFunctionality()
    {
        $subject = $this->createSubject();
        
        $locator1 = $this->createClassLocator();
        $locator2 = $this->createClassLocator();
        $locator1->setClass('Dhii\\SimpleTest\\Test\\Stub\\MyTestCaseTest');
        $locator2->setClass('Dhii\\SimpleTest\\Test\\Stub\\More\\MyTestCase1Test');
        $suite1 = $subject->createSuite(uniqid('test-suite'));
        $suite2 = $subject->createSuite(uniqid('test-suite'));
        $suite1->addTests($locator1->locate());
        $suite2->addTests($locator2->locate());
        $subject->addSuite($suite1);
        $subject->addSuite($suite2);
        
        ob_start();
        $result = $subject->runAll();
        /* @var $result \Dhii\SimpleTest\Test\ResultSetCollection */
        $output = ob_get_clean();
        $suites = iterator_to_array($result->getArrayIterator());
        
        $this->assertEquals(2, count($suites), 'The number of test suites in result is wrong');
        $this->assertEquals(8, count($result), 'The total number of test results is wrong');
        $this->assertEquals(8, $result->getTestCount(), 'The total test count is wrong');
        
        $successfulResults = $result->getResultsByStatus(\Dhii\SimpleTest\Test\ResultInterface::SUCCESS);
        $this->assertInstanceOf('Dhii\SimpleTest\Test\ResultSetInterface', $successfulResults, 'Search on tester results does not produe a valid result set');
        foreach ($result as $_result) {
            $this->assertInstanceOf('Dhii\SimpleTest\Test\ResultInterface', $_result, 'A search result set does not contain valid items');
        }
        $this->assertEquals(4, count($successfulResults), 'The number of successful tests is wrong');
    }
    
    /**
     * Tests whether the main functionality produces the correct output under default circumstances.
     * 
     * All dependencies implicit.
     * 
     * @since 0.1.0
     */
    public function testRunAllOutput()
    {
        $subject = $this->createSubject();
        
        $locator = $this->createClassLocator();
        $locator->setClass('Dhii\\SimpleTest\\Test\\Stub\\MyTestCaseTest');
        $suite = $subject->createSuite(uniqid('test-suite'));
        $suite->addTests($locator->locate());
        $subject->addSuite($suite);
        
        ob_start();
        $result = $subject->runAll();
        $output = ob_get_clean();
        
        $this->assertContains('Test Dhii\\SimpleTest\\Test\\Stub\\MyTestCaseTest#testError erred', $output, 'Testing output did not contain notice of failed test');
    }
}
