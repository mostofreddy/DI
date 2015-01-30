<?php
/**
 * BuilderFromCache.php
 *
 * PHP version 5.4+
 *
 * Copyright (c) 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed
 * with this source code.
 *
 * @category  Di
 * @package   Zendo\Di
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Zendo\Di;
use Zendo\Di\AbstractBuilder;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
/**
 * BuilderFromCache
 *
 * Copyright (c) 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed
 * with this source code.
 *
 * @category  Di
 * @package   Zendo\Di
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class BuilderFromCache extends AbstractBuilder
{
    protected $classNameCache = 'ZendoRestyDiContainer';
    protected $isDebug = false;
    protected $cacheDir = '/tmp/';

    /**
     * Set cache dir
     *
     * @param string $cacheDir cache dir
     *
     * @return self
     */
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = $cacheDir;
        return $this;
    }
    /**
     * Return cache dir
     *
     * @return string
     */
    public function getCacheDir()
    {
        return $this->cacheDir;
    }
    /**
     * Set debug mode
     *
     * @param bool $isDebug enable/disable debug mode.
     *
     * @return self
     */
    public function setIsDebug($isDebug)
    {
        $this->isDebug = $isDebug;
        return $this;
    }
    /**
     * Return debug mode
     *
     * @return bool
     */
    public function getIsDebug()
    {
        return $this->isDebug;
    }
    /**
     * Set name form cache class
     *
     * @param string $name name
     *
     * @return self
     */
    public function setClassNameCache($name)
    {
        $this->classNameCache = $name;
        return $this;
    }
    /**
     * Return cache class name
     *
     * @return string
     */
    public function getClassNameCache()
    {
        return $this->classNameCache;
    }
    /**
     * Get an ContainerBuilder
     *
     * @return ContainerBuilder
     */
    public function get()
    {
        $file = $this->renderCacheFileFullPath();
        $containerConfigCache = new ConfigCache($file, $this->isDebug);

        if (!$containerConfigCache->isFresh()) {
            $containerBuilder = $this->getContainerBuilder();
            $containerBuilder->compile();
            $this->createCache($containerBuilder, $containerConfigCache);
        }

        include_once $file;
        return new $this->classNameCache();
    }
    /**
     * Return cache full path
     *
     * @return string
     */
    protected function renderCacheFileFullPath()
    {
        return $this->cacheDir.$this->classNameCache.".php";
    }
    /**
     * Create and save cache
     *
     * @param ContainerBuilder $containerBuilder     [description]
     * @param ConfigCache      $containerConfigCache [description]
     *
     * @return void
     */
    protected function createCache(ContainerBuilder $containerBuilder, ConfigCache $containerConfigCache)
    {
        $dumper = new PhpDumper($containerBuilder);
        $containerConfigCache->write(
            $dumper->dump(array('class' => $this->classNameCache)),
            $containerBuilder->getResources()
        );
    }
}
