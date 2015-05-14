<?php
/**
 * AbstractBuilderTest
 *
 * PHP version 5.4+
 *
 * Copyright (c) 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed
 * with this source code.
 *
 * @category  Di
 * @package   Zendo\Di\Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Zendo\Di\Tests;
/**
 * AbstractBuilderTest
 *
 * @category  Di
 * @package   Zendo\Di\Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class AbstractBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test method addConfigurationDirectories
     * 
     * @return void
     */
    public function testAddConfigurationDirectories()
    {
        $expected = ['tmp'];
        $stub = $this->getMockForAbstractClass('Zendo\Di\AbstractBuilder');
        $stub->addConfigurationDirectories($expected);
        $this->assertAttributeEquals($expected, 'directories', $stub);
    }
    /**
     * Test method addConfigurationFiles
     * 
     * @return void
     */
    public function testAddConfigurationFiles()
    {
        $expected = ['config.yml'];
        $stub = $this->getMockForAbstractClass('Zendo\Di\AbstractBuilder');
        $stub->addConfigurationFiles($expected);
        $this->assertAttributeEquals($expected, 'files', $stub);
    }
    /**
     * Test method getConfiguration
     * 
     * @return void
     */
    public function testGetConfiguration()
    {
        $files = ['config.yml'];
        $dirs = ['/tmp'];
        $stub = $this->getMockForAbstractClass('Zendo\Di\AbstractBuilder');
        $stub->addConfigurationFiles($files);
        $stub->addConfigurationDirectories($dirs);
        $expected = [
            'directories' => $dirs,
            'files' => $files
        ];
        $this->assertEquals($expected, $stub->getConfiguration());
    }
    /**
     * Test method getContainerBuilder
     * 
     * @return void
     */
    public function testGetContainerBuilder()
    {
        $ref = new \ReflectionMethod('Zendo\Di\AbstractBuilder', 'getContainerBuilder');
        $ref->setAccessible(true);
        $stub = $this->getMockForAbstractClass('Zendo\Di\AbstractBuilder');
        $this->assertInstanceOf('Zendo\Di\DependencyInjection\ContainerBuilder', $ref->invoke($stub));
    }

    /**
     * Test method getContainerBuilder
     *
     * @expectedException \InvalidArgumentException
     * 
     * @return void
     */
    public function testGetContainerBuilderExceptionFileNoFound()
    {
        $ref = new \ReflectionMethod('Zendo\Di\AbstractBuilder', 'getContainerBuilder');
        $ref->setAccessible(true);
        $stub = $this->getMockForAbstractClass('Zendo\Di\AbstractBuilder');
        $stub->addConfigurationDirectories(['/tmp']);
        $stub->addConfigurationFiles(['dummy']);
        $this->assertInstanceOf('Zendo\Di\DependencyInjection\ContainerBuilder', $ref->invoke($stub));
    }

    /**
     * Test method getContainerBuilder
     *
     * @return void
     */
    public function testGetContainerBuilderFileFound()
    {
        $ref = new \ReflectionMethod('Zendo\Di\AbstractBuilder', 'getContainerBuilder');
        $ref->setAccessible(true);
        $stub = $this->getMockForAbstractClass('Zendo\Di\AbstractBuilder');
        $stub->addConfigurationDirectories([realpath(__DIR__.'/../').'/helpers']);
        $stub->addConfigurationFiles(['config.yml']);
        $this->assertInstanceOf('Zendo\Di\DependencyInjection\ContainerBuilder', $ref->invoke($stub));
    }
}
