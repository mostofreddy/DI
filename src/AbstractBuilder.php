<?php
/**
 * AbstractBuilder.php
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
use Zendo\Di\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
/**
 * AbstractBuilder
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
abstract class AbstractBuilder
{
    protected $directories = [];
    protected $files = [];
    /**
     * Add directories & configurations files
     *
     * @param array $directories [description]
     * @param array $files       [description]
     *
     * @return self
     */
    public function addConfigurationFile(array $directories, array $files)
    {
        $this->directories[] = $directories;
        $this->files[] = $files;
        return $this;
    }
    /**
     * Return directories & configuration files
     *
     * @return array
     */
    public function getConfigurationFile()
    {
        return [
            'directories' => $this->directories,
            'files' => $this->files
        ];
    }
    /**
     * Create an instance of ContainerBuilder
     *
     * @return ContainerBuilder
     */
    protected function getContainerBuilder()
    {
        $containerBuilder = new ContainerBuilder();
        $this->loadConfigurationFiles($containerBuilder);
        return $containerBuilder;
    }
    /**
     * Load configuration file into ContainerBuilder
     *
     * @param ContainerBuilder $containerBuilder [description]
     *
     * @return void
     */
    protected function loadConfigurationFiles(ContainerBuilder $containerBuilder)
    {
        $count = count($this->directories);
        for ($i=0; $i<$count; $i++) {
            $loader = $this->createYamlFileLoaderInstance($containerBuilder, $this->createFileLocatorInstance($this->directories[$i]));
            foreach ($this->files[$i] as $file) {
                $loader->load($file);
            }
        }
    }
    /**
     * Create an instance of YamlFileLoader
     *
     * @param ContainerBuilder $containerBuilder An instance of ContainerBuilder
     * @param FileLocator      $fileLocator      An instance of FileLocator
     *
     * @return YamlFileLoader
     */
    protected function createYamlFileLoaderInstance(ContainerBuilder $containerBuilder, FileLocator $fileLocator)
    {
        return new YamlFileLoader($containerBuilder, $fileLocator);
    }
    /**
     * Create an instance of FileLocator
     *
     * @param string $directory location of the configuration files
     *
     * @return FileLocator
     */
    protected function createFileLocatorInstance($directory)
    {
        return new FileLocator($directory);
    }
}
