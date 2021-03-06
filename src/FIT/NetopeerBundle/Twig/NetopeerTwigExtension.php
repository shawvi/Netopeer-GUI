<?php
/**
 * File extends twig extension with custom functions.
 *
 * This functions could be used in TWIG template.
 *
 * @file    NetopeerTwigExtension.php
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
 */

namespace FIT\NetopeerBundle\Twig;

use Twig_Extension;
use Twig_Function_Method;

/**
 * Registers custom functions, which could be used in templates
 */
class NetopeerTwigExtension extends Twig_Extension
{
	/**
	 * Defines array of custom defined functions
	 *
	 * @return array
	 */
	public function getFunctions()
    {
        return array(
            'isNumberType' => new Twig_Function_Method($this, 'isNumberType'),
            'isUrlType' => new Twig_Function_Method($this, 'isUrlType'),
            'explode' => new Twig_Function_Method($this, 'explodeString'),
	          'array_unique' => new Twig_Function_Method($this, 'arrayUnique')
        );
    }

	/**
	 * Check if param is number
	 *
	 * @param string|mixed $string  value (string), which we check, if is a number
	 * @return bool
	 */
	public function isNumberType($string)
    {
        if ( strrpos($string, 'int') === false ) {
            return false;
        }

        return true;
    }

	/**
	 * Check if param is URI
	 *
	 * @param string  $string check, if value is an URI
	 * @return bool
	 */
	public function isUrlType($string)
    {
        if ( $string == "inet:uri" ) return true;
        return false;
    }

	/**
	 * Explode function
	 *
	 * @param string $delimiter
	 * @param string $string      string to explode
	 * @return array
	 */
	public function explodeString($delimiter, $string) {
        return explode($delimiter, $string);
    }

	/**
	 * Array unique function
	 *
	 * @param array $array
	 * @return array
	 */
	public function arrayUnique($array) {
		return array_unique($array);
	}

	/**
	 * Get name of this extension
	 *
	 * @return string
	 */
	public function getName()
    {
        return 'netopeer_twig_extension';
    }
}
