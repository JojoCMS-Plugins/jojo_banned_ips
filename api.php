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

/* intercept before sending to smarty */
Jojo::addHook('before_fetch_template', 'before_fetch_template', 'jojo_banned_ips');
Jojo::addFilter('cached_content', 'cached_content', 'jojo_banned_ips');

/* add option for enabling / disabling simplecloak */
$_options[] = array(
    'id'          => 'banned_ips_enabled',
    'category'    => 'SEO',
    'label'       => 'Enable banned_ip',
    'description' => 'Bans certain IPs from accessing your website',
    'type'        => 'radio',
    'default'     => 'no',
    'options'     => 'yes,no',
    'plugin'      => 'jojo_banned_ips'
);

$_options[] = array(
    'id'          => 'banned_ips',
    'category'    => 'SEO',
    'label'       => 'Banned IPs',
    'description' => 'Add each IP address on its own line.',
    'plugin'      => 'jojo_banned_ips',
    'type'        => 'textarea',
    'default'     => '',
    'options'     => ''
);