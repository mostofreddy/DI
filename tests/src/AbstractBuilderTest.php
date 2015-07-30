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
     * Test method addDirectories
     * 
     * @return void
     */
    public function testaddDirectories()
    {
        $expected = ['tmp'];
        $stub = $this->getMockForAbstractClass('Zendo\Di\AbstractBuilder');
        $stub->addDirectories($expected);
        $this->assertAttributeEquals($expected, 'directories', $stub);
    }
    /**
     * Test method addFiles
     * 
     * @return void
     */
    public function testaddFiles()
    {
        $expected = ['config.yml'];
        $stub = $this->getMockForAbstractClass('Zendo\Di\AbstractBuilder');
        $stub->addFiles($expected);
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
        $stub->addFiles($files);
        $stub->addDirectories($dirs);
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
     * @return void
     */
    public function testGetContainerBuilderFileFound()
    {
        $ref = new \ReflectionMethod('Zendo\Di\AbstractBuilder', 'getContainerBuilder');
        $ref->setAccessible(true);
        $stub = $this->getMockForAbstractClass('Zendo\Di\AbstractBuilder');
        $stub->addDirectories([realpath(__DIR__.'/../').'/helpers']);
        $stub->addFiles(['config.yml']);
        $this->assertInstanceOf('Zendo\Di\DependencyInjection\ContainerBuilder', $ref->invoke($stub));
    }
}
