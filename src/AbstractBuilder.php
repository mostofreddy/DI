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

use Zendo\Di\DependencyInjection\ContainerBuilder;
use Zendo\Di\Config\FileLocator;
// Symfony - DependencyInjection
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * AbstractBuilder
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
     * Add directories to search
     *
     * @param array $directories Paths
     *
     * @return self
     */
    public function addConfigurationDirectories(array $directories)
    {
        $this->directories = array_merge($this->directories, $directories);
        return $this;
    }
    /**
     * Add configuration filenames
     *
     * @param array $files Filenames
     *
     * @return self
     */
    public function addConfigurationFiles(array $files)
    {
        $this->files = array_merge($this->files, $files);
        return $this;
    }
    /**
     * Return all configuration
     *
     * @return array Example:
     *                  [
     *                      'directories' => []
     *                      'files' => []
     *                  ]
     */
    public function getConfiguration()
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
        $fileLocator = new FileLocator();
        $ymlLoader = new YamlFileLoader($containerBuilder, $fileLocator);
        foreach ($this->directories as $directory) {
            $fileLocator->replacePaths($directory);
            foreach ($this->files as $file) {
                $ymlLoader->load($file);
            }
        }
    }
}
