<?php
/**
 *                    Jojo CMS
 *                ================
 *
 * Copyright 2007-2008 Harvey Kane <code@ragepank.com>
 * Copyright 2007-2008 Michael Holt <code@gardyneholt.co.nz>
 * Copyright 2007 Melanie Schulz <mel@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Harvey Kane <code@ragepank.com>
 * @author  Michael Cochrane <mikec@jojocms.org>
 * @author  Melanie Schulz <mel@gardyneholt.co.nz>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 * @package jojo_core
 */

class Jojo_Plugin_Jojo_php51 extends Jojo_Plugin
{
    function jojo_before_parsepage()
    {
        /* include json_encode and json_decode functions */
        if(!function_exists('json_encode')) {
            foreach (Jojo::listPlugins('external/JSON/JSON.php') as $pluginfile) {
                require_once($pluginfile);
                break;
            }
            
            $GLOBALS['JSON_OBJECT'] = new Services_JSON();
            
            function json_encode($value)
            {
                return $GLOBALS['JSON_OBJECT']->encode($value);
            }
            
            function json_decode($value)
            {
                return $GLOBALS['JSON_OBJECT']->decode($value);
            }
        }
        return true;
    }
}