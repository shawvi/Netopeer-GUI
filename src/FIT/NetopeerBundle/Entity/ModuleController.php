<?php
/**
 * Entity for mapping module into array of available moduleBundles
 * (how should be bundle rendered)
 *
 * @file GenerateController.php
 * @author David Alexa <alexa.david@me.com>
 *
 * Copyright (C) 2012-2015 CESNET
 *
 * LICENSE TERMS
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in
 *    the documentation and/or other materials provided with the
 *    distribution.
 * 3. Neither the name of the Company nor the names of its contributors
 *    may be used to endorse or promote products derived from this
 *    software without specific prior written permission.
 *
 * ALTERNATIVELY, provided that this notice is retained in full, this
 * product may be distributed under the terms of the GNU General Public
 * License (GPL) version 2 or later, in which case the provisions
 * of the GPL apply INSTEAD OF those given above.
 *
 * This software is provided ``as is'', and any express or implied
 * warranties, including, but not limited to, the implied warranties of
 * merchantability and fitness for a particular purpose are disclaimed.
 * In no event shall the company or contributors be liable for any
 * direct, indirect, incidental, special, exemplary, or consequential
 * damages (including, but not limited to, procurement of substitute
 * goods or services; loss of use, data, or profits; or business
 * interruption) however caused and on any theory of liability, whether
 * in contract, strict liability, or tort (including negligence or
 * otherwise) arising in any way out of the use of this software, even
 * if advised of the possibility of such damage.
 *
 */
namespace FIT\NetopeerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModuleController
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ModuleController
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="moduleName", type="string", length=50)
     */
    private $moduleName;

    /**
     * @var string
     *
     * @ORM\Column(name="moduleNamespace", type="string", length=255)
     */
    private $moduleNamespace;

    /**
     * @var array
     *
     * @ORM\Column(name="controllerActions", type="simple_array")
     */
    private $controllerActions;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set moduleName
     *
     * @param string $moduleName
     * @return ModuleController
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
    
        return $this;
    }

    /**
     * Get moduleName
     *
     * @return string 
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * Set moduleNamespace
     *
     * @param string $moduleNamespace
     * @return ModuleController
     */
    public function setModuleNamespace($moduleNamespace)
    {
        $this->moduleNamespace = $moduleNamespace;
    
        return $this;
    }

    /**
     * Get moduleNamespace
     *
     * @return string 
     */
    public function getModuleNamespace()
    {
        return $this->moduleNamespace;
    }

    /**
     * Set controllerActions
     *
     * @param array $controllerActions
     * @return ModuleController
     */
    public function setControllerActions($controllerActions)
    {
        $this->controllerActions = $controllerActions;
    
        return $this;
    }

    /**
     * Get controllerActions
     *
     * @return array 
     */
    public function getControllerActions()
    {
        return $this->controllerActions;
    }
}