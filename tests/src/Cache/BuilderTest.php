<?php
/**
 * BuilderTest
 *
 * PHP version 5.4+
 *
 * Copyright (c) 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed
 * with this source code.
 *
 * @category  Di
 * @package   Zendo\Di\Tests\Cache
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Zendo\Di\Tests\Cache;
/**
 * BuilderTest
 *
 * @category  Di
 * @package   Zendo\Di\Tests\Cache
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class BuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test method setCacheDir
     * 
     * @return void
     */
    public function testSetCacheDir()
    {
        $expected = 'tmp';
        $builder = new \Zendo\Di\Cache\Builder();
        $builder->setCacheDir($expected);
        $this->assertEquals($expected, $builder->getCacheDir());
    }
    /**
     * Test method setIsDebug
     * 
     * @return void
     */
    public function testSetIsDebug()
    {
        $expected = true;
        $builder = new \Zendo\Di\Cache\Builder();
        $builder->setIsDebug($expected);
        $this->assertEquals($expected, $builder->getIsDebug());
    }
    /**
     * Test method setClassNameCache
     * 
     * @return void
     */
    public function testSetClassNameCache()
    {
        $expected = 'MyCacheClass';
        $builder = new \Zendo\Di\Cache\Builder();
        $builder->setClassNameCache($expected);
        $this->assertEquals($expected, $builder->getClassNameCache());
    }
    /**
     * Test method addCustomParameters
     * 
     * @return void
     */
    public function testAddCustomParameters()
    {
        $value = 'MyCacheClass';
        $key = 'myKey';
        $builder = new \Zendo\Di\Cache\Builder();
        $builder->addCustomParameters($key, $value);
        $expected = [$key => $value];
        $this->assertAttributeEquals($expected, "customParameters", $builder);
    }
    /**
     * Test method renderCacheFileFullPath
     * 
     * @return void
     */
    public function testRenderCacheFileFullPath()
    {
        $ref = new \ReflectionMethod('\Zendo\Di\Cache\Builder', 'renderCacheFileFullPath');
        $ref->setAccessible(true);
        $expectedName = 'MyCacheClass';
        $expectedDir = '/tmp';
        $builder = new \Zendo\Di\Cache\Builder();
        $builder->setClassNameCache($expectedName);
        $builder->setCacheDir($expectedDir);

        $expected = $expectedDir.$expectedName.'.php';
        $this->assertEquals($expected, $ref->invoke($builder));
    }

}
