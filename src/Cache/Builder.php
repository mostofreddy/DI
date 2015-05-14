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
 * @package   Zendo\Di\Cache
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Zendo\Di\Cache;
use Zendo\Di\AbstractBuilder;
use Zendo\Di\DependencyInjection\ContainerBuilder;
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
 * @package   Zendo\Di\Cache
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class Builder extends AbstractBuilder
{
    protected $classNameCache = 'ZendoRestyDiContainer';
    protected $isDebug = false;
    protected $cacheDir = '/tmp/';
    protected $customParameters = [];

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
     * Agrega un parametro custom al DI.
     * Este metodo es utilizado cuando se usa cache y existen parametros que al ser calculables no pueden formar parte del 
     * archivo .yml de configuracion
     * 
     * @param string $key   clave del parametro
     * @param mixed  $value valor del parametro
     *
     * @return selg
     */
    public function addCustomParameters($key, $value)
    {
        $this->customParameters[$key] = $value;
        return $this;
    }
    /**
     * Agrega al container los parametros custom antes de compilarlo y generar el cache
     *
     * @param ContainerBuilder $containerBuilder instancia de ContainerBuilder
     * 
     * @return self
     */
    protected function setCustomParameters($containerBuilder)
    {
        foreach ($this->customParameters as $key => $value) {
            $containerBuilder->setParameter($key, $value);
        }
        return $this;
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
            echo "aaaaaaaaaaaa";
            $this->setCustomParameters($containerBuilder);
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
