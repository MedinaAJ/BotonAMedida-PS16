<?php 
/*
* minicskeleton - a module template for Prestashop v1.5+
* Copyright (C) 2013 S.C. Minic Studio S.R.L.
* 
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
* 
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if (!defined('_PS_VERSION_'))
  exit;
 
class BotonAMedida extends Module
{
	// DB file
	const INSTALL_SQL_FILE = 'install.sql';

	public function __construct()
	{
		$this->name = 'botonamedida';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Alejandro Medina';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.7'); 
		// $this->dependencies = array('blockcart');

		parent::__construct();

		$this->displayName = $this->l('Boton a Medida');
		$this->description = $this->l('Anyade un boton a los productos en el front');

		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	}

	/**
 	 * install
	 */
	public function install()
	{
		// Create DB tables - uncomment below to use the install.sql for database manipulation
		/*
		if (!file_exists(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
			return false;
		else if (!$sql = file_get_contents(dirname(__FILE__).'/'.self::INSTALL_SQL_FILE))
			return false;
		$sql = str_replace(array('PREFIX_', 'ENGINE_TYPE'), array(_DB_PREFIX_, _MYSQL_ENGINE_), $sql);
		// Insert default template data
		$sql = str_replace('THE_FIRST_DEFAULT', serialize(array('width' => 1, 'height' => 1)), $sql);
		$sql = str_replace('FLY_IN_DEFAULT', serialize(array('width' => 1, 'height' => 1)), $sql);
		$sql = preg_split("/;\s*[\r\n]+/", trim($sql));

		foreach ($sql as $query)
			if (!Db::getInstance()->execute(trim($query)))
				return false;
		*/

		return parent::install() && $this->registerHook('displayMediHookBoton') && $this->registerHook('displayHeader') &&
      		$this->registerHook('displayBackOfficeHeader') && $this->registerHook('displayAdminHomeQuickLinks');
	}

	/**
 	 * uninstall
	 */
	public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}

	/**
 	 * admin page
	 */	
	public function getContent()
	{
		return $this->display(__FILE__, 'views/templates/admin/botonamedida.tpl');
	}

	// BACK OFFICE HOOKS

	/**
 	 * admin <head> Hook
	 */
	public function hookDisplayBackOfficeHeader()
	{
		// CSS
		$this->context->controller->addCSS($this->_path.'views/css/elusive-icons/elusive-webfont.css');
		// JS
		// $this->context->controller->addJS($this->_path.'views/js/js_file_name.js');	
	}

	/**
	 * Hook for back office dashboard
	 */
	public function hookDisplayAdminHomeQuickLinks()
	{	
		$this->context->smarty->assign('botonamedida', $this->name);
	    return $this->display(__FILE__, 'views/templates/hooks/quick_links.tpl');    
	}

	// FRONT OFFICE HOOKS
	
	/**
	* Footer After Product Thumbs Hook
	*/
	public function hookDisplayMediHookBoton($params){		
		$id_product = (int) Tools::getValue('id_product');
		//echo 'ID: '.$id_product;
		$link_custom = Db::getInstance()->executeS('Select link_custom_product From ' . _DB_PREFIX_ . 'boton_a_medida Where id_product ='.$id_product.';');
		//echo '<br>SQL: '.'Select link_custom_product From ' . _DB_PREFIX_ . 'boton_a_medida Where id_product ='.$id_product.';';
		//echo '<p>vc: '. count($link_custom).'</p>';
		//echo 'Enlace 1:',$link_products[0]['image_link'];
		//$s = $this::topperValido('140 X 150');

		//if (!isset($link_custom[0])){
		//	$link_custom[0] = '';
		//}

		$this->smarty->assign('link_custom', $link_custom);
	    return $this->display(__FILE__, 'views/templates/front/_display.tpl');  
	}
	
	
}

?>
