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
 * @package   Zendo\Di\Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Zendo\Di\Tests;
/**
 * BuilderTest
 *
 * @category  Di
 * @package   Zendo\Di\Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class BuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test method get
     * 
     * @return void
     */
    public function testGet()
    {
        $builder = new \Zendo\Di\Builder();
        $container = $builder->get();
        $this->assertInstanceOf('Zendo\Di\DependencyInjection\ContainerBuilder', $container);
    }
}
