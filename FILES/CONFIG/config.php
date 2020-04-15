<?php
interface settings {
	const d_url = "http://localhost:2000"; // url use by system
	const d_assets = '/PROJECT/FILES'; // assets url directory
	const d_path = '../PROJECT/FILES'; // root directory 
	
#DATABASE SETTINGS
	const db_host = "localhost";
	const db_user = "dammmba";
	const db_port = 3306;
	const db_pass = "dammmba";
	const db_database = "management_dammmba";

#TEMPLATE SETTINGS
	const c_title = 'Title';
	const c_description = 'Sample Description';

#TEMPLATES
	const t_main = '/TEMPLATE/Default/main.html';
	const t_sidebar = '/TEMPLATE/Main/sidebar_v1.html';
	const t_header = '/TEMPLATE/Main/header.html';
	const t_footer = '/TEMPLATE/Main/footer.html';
	const t_themer = '/TEMPLATE/Main/themer.html';
	const t_slidechat = '/TEMPLATE/Main/slidechat.html';
	
#ASSETS	
	const t_assets = '/ASSETS';
	const t_js = '/JS';
	const t_css = '/CSS';
	const t_cc = '/CUSTOM';
	const t_plugin = '/PLUGIN';
}

?>