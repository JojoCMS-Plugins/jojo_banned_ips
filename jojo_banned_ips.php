<?php
/**
 *                    Jojo CMS
 *                ================
 *
 * Copyright 2008 Harvey Kane <code@ragepank.com>
 * Copyright 2008 Michael Holt <code@gardyneholt.co.nz>
 *
 * See the enclosed file license.txt for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Michael Brandon <code@searchmasters.co.nz>
 * @author  Harvey Kane <code@ragepank.com>
 * @license http://www.fsf.org/copyleft/lgpl.html GNU Lesser General Public License
 * @link    http://www.jojocms.org JojoCMS
 * @package jojo_core
 */

class JOJO_Plugin_jojo_banned_ips extends JOJO_Plugin
{
    function before_fetch_template()
    {
        self::check();
    }
    
    function cached_content($html)
    {
        self::check();
    }
    
    function check()
    {
        if (Jojo::getOption('banned_ips_enabled') == 'no') return true;
        $banned_ips = Jojo::getOption('banned_ips', '');
        $banned_ips=preg_split("/[\s,]+/", $banned_ips, -1, PREG_SPLIT_NO_EMPTY);
        $banned_ips = Jojo::applyFilter('jojo_banned_ip_list', $banned_ips); //allow plugins to edit the ban list

        if (in_array(getenv('REMOTE_ADDR'), $banned_ips) || in_array(getenv('HTTP_X_FORWARDED_FOR'), $banned_ips)) {
            global $smarty;
            $smarty->display('jojo_banned_ips.tpl');
            exit;
        }
        return;
    }
}