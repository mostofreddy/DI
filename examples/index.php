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


$config = [$rootPath."/examples/"];
$files = ['parameters.yml', 'services.yml'];
$cacheDir = $rootPath."/examples/cache/";
$isDebug = true;

$builder = new \Zendo\Di\BuilderFromCache();
$builder->addConfigurationFile($config, $files)
    ->setCacheDir($cacheDir)
    ->setIsDebug($isDebug);
$container = $builder->get();

echo "<pre>".print_r($container->getParameter('name'), true)."</pre>";
echo "<pre>".print_r($container->get('Dummy'), true)."</pre>";
