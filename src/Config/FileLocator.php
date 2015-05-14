<?php
/**
 * FileLocator.php
 *
 * PHP version 5.4+
 *
 * Copyright (c) 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed
 * with this source code.
 *
 * @category  Di
 * @package   Zendo\Di\Config
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Zendo\Di\Config;

use Symfony\Component\Config\FileLocator as SfFileLocator;

/**
 * FileLocator
 *
 * @category  Di
 * @package   Zendo\Di\Config
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2015 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class FileLocator extends SfFileLocator
{
    /**
     * Reemplaza los paths definidos en el FileLocator
     *
     * @param array $path paths donde ubicar los distintos archivos
     *
     * @return void
     */
    public function replacePaths($paths = [])
    {
        $this->paths = (array) $paths;
    }
}
