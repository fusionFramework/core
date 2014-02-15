<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Move asset files out of the modules into your HTDOCPATH/assets
 * so they won't have to be routed through Kohana no more.
 *
 * Optionally there's a parameter called overwrite (defaults to true),
 * if set to false it won't overwrite existing asset files.
 *
 * @package    fusionFramework
 * @category   Core/Assets
 * @author     Maxim Kerstens
 */
class Task_Assets_Publish extends Fusion_Task_Assets_Publish
{

}