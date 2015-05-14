<?php
/**
 * Index.php
 *
 * Copyright (c) 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed
 * with this source code.
 *
 * @category  Di
 * @package   Zendo\Di\Examples
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */

$rootPath = realpath(__DIR__.'/../');
require_once $rootPath."/vendor/autoload.php";
require_once $rootPath."/examples/src/ClassA.php";


$paths = [
    $rootPath."/examples/config1",
    $rootPath."/examples/config2",
];
$files = ['config.yml'];
$cacheDir = $rootPath."/examples/cache/";
$isDebug = true;

$builder = new \Zendo\Di\Cache\Builder();
$builder->addConfigurationFiles($files)
    ->addConfigurationDirectories($paths);

$container = $builder->get();

echo "<pre>".print_r($container->getParameter('name'), true)."</pre>";
echo "<pre>".print_r($container->getParameter('year'), true)."</pre>";
echo "<pre>".print_r($container->get('Dummy'), true)."</pre>";

echo "DONE";
