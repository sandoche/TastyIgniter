<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

class Migration_Schema extends CI_Migration {

	public function up() {
		$this->load->database();
		$this->load->dbforge();
		
		$this->_addresses();
		$this->_banners();
		$this->_categories();
		$this->_countries();
		$this->_coupons();
		$this->_coupons_history();
		$this->_currencies();
		$this->_customers();
		$this->_customers_activity();
		$this->_customer_groups();
		$this->_extensions();
		$this->_languages();
		$this->_layouts();
		$this->_layout_routes();
		$this->_locations();
		$this->_location_tables();
		$this->_mail_templates();
		$this->_mail_templates_data();
		$this->_menus();
		$this->_menus_specials();
		$this->_menus_to_options();
		$this->_menu_options();
		$this->_messages();
		$this->_message_recipients();
		$this->_orders();
		$this->_order_menus();
		$this->_order_options();
		$this->_order_totals();
		$this->_pages();
		$this->_permalinks();
		$this->_pp_payments();
		$this->_reservations();
		$this->_reviews();
		$this->_security_questions();
		$this->_settings();
		$this->_staffs();
		$this->_staff_groups();
		$this->_statuses();
		$this->_status_history();
		$this->_tables();
		$this->_uri_routes();
		$this->_users();
		$this->_working_hours();
	}

	public function down() {
		$this->dbforge->drop_table('addresses');
		$this->dbforge->drop_table('banners');
		$this->dbforge->drop_table('categories');
		$this->dbforge->drop_table('countries');
		$this->dbforge->drop_table('coupons');
		$this->dbforge->drop_table('coupons_history');
		$this->dbforge->drop_table('currencies');
		$this->dbforge->drop_table('customers');
		$this->dbforge->drop_table('customers_activity');
		$this->dbforge->drop_table('customer_groups');
		$this->dbforge->drop_table('extensions');
		$this->dbforge->drop_table('languages');
		$this->dbforge->drop_table('layouts');
		$this->dbforge->drop_table('layout_routes');
		$this->dbforge->drop_table('locations');
		$this->dbforge->drop_table('location_tables');
		$this->dbforge->drop_table('mail_templates');
		$this->dbforge->drop_table('mail_templates_data');
		$this->dbforge->drop_table('menus');
		$this->dbforge->drop_table('menus_specials');
		$this->dbforge->drop_table('menus_to_options');
		$this->dbforge->drop_table('menu_options');
		$this->dbforge->drop_table('messages');
		$this->dbforge->drop_table('message_recipients');
		$this->dbforge->drop_table('orders');
		$this->dbforge->drop_table('order_menus');
		$this->dbforge->drop_table('order_options');
		$this->dbforge->drop_table('order_totals');
		$this->dbforge->drop_table('pages');
		$this->dbforge->drop_table('permalinks');
		$this->dbforge->drop_table('pp_payments');
		$this->dbforge->drop_table('reservations');
		$this->dbforge->drop_table('reviews');
		$this->dbforge->drop_table('security_questions');
		$this->dbforge->drop_table('settings');
		$this->dbforge->drop_table('staffs');
		$this->dbforge->drop_table('staff_groups');
		$this->dbforge->drop_table('statuses');
		$this->dbforge->drop_table('status_history');
		$this->dbforge->drop_table('tables');
		$this->dbforge->drop_table('uri_routes');
		$this->dbforge->drop_table('users');
		$this->dbforge->drop_table('working_hours');
	}

	public function _addresses() {
		$this->dbforge->drop_table('addresses');
		
		$fields = array(
			'address_id INT(11) NOT NULL AUTO_INCREMENT',
			'customer_id INT(15) NOT NULL',
			'address_1 VARCHAR(128) NOT NULL',
			'address_2 VARCHAR(128) NOT NULL',
			'city VARCHAR(128) NOT NULL',
			'state VARCHAR(128) NOT NULL',
			'postcode VARCHAR(10) NOT NULL',
			'country_id INT(11) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('address_id', TRUE);
		$this->dbforge->create_table('addresses');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('addresses').' AUTO_INCREMENT 11');
	}

	public function _banners() {
		$this->dbforge->drop_table('banners');
		
		$fields = array(
			'banner_id INT(11) NOT NULL AUTO_INCREMENT',
			'name VARCHAR(255) NOT NULL',
			'type CHAR(8) NOT NULL',
			'click_url VARCHAR(255) NOT NULL',
			'language_id INT(11) NOT NULL',
			'alt_text VARCHAR(255) NOT NULL',
			'image_code TEXT NOT NULL',
			'custom_code TEXT NOT NULL',
			'status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('banner_id', TRUE);
		$this->dbforge->create_table('banners');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('banners').' AUTO_INCREMENT 11');
	}

	public function _categories() {
		$this->dbforge->drop_table('categories');

		$fields = array(
			'category_id INT(11) NOT NULL AUTO_INCREMENT',
			'name VARCHAR(32) NOT NULL',
			'description TEXT NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('category_id', TRUE);
		$this->dbforge->create_table('categories');
	}

	public function _countries() {
		$this->dbforge->drop_table('countries');

		$fields = array(
			'country_id INT(11) NOT NULL AUTO_INCREMENT',
			'country_name VARCHAR(128) NOT NULL',
			'iso_code_2 VARCHAR(2) NOT NULL',
			'iso_code_3 VARCHAR(3) NOT NULL',
			'format TEXT NOT NULL',
			'status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('country_id', TRUE);
		$this->dbforge->create_table('countries');
	}

	public function _coupons() {
		$this->dbforge->drop_table('coupons');

		$fields = array(
			'coupon_id INT(11) NOT NULL AUTO_INCREMENT',
			'name VARCHAR(128) NOT NULL',
			'code VARCHAR(15) NOT NULL',
			'type CHAR(1) NOT NULL',
			'discount DECIMAL(15,2) NOT NULL',
			'min_total DECIMAL(15,2) NOT NULL',
			'redemptions INT(11) NOT NULL DEFAULT "0"',
			'customer_redemptions INT(11) NOT NULL DEFAULT "0"',
			'description TEXT NOT NULL',
			'start_date DATE NOT NULL',
			'end_date DATE NOT NULL',
			'status TINYINT(1) NOT NULL',
			'date_added DATE NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('coupon_id', TRUE);
		$this->dbforge->create_table('coupons');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('coupons').' AUTO_INCREMENT 11');
	}

	public function _coupons_history() {
		$this->dbforge->drop_table('coupons_history');

		$fields = array(
			'coupon_history_id INT(11) NOT NULL AUTO_INCREMENT',
			'coupon_id INT(11) NOT NULL',
			'order_id INT(11) NOT NULL',
			'customer_id INT(11) NOT NULL',
			'code VARCHAR(15) NOT NULL',
			'min_total DECIMAL(15,2) NOT NULL',
			'amount DECIMAL(15,2) NOT NULL',
			'date_used DATETIME NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('coupon_history_id', TRUE);
		$this->dbforge->create_table('coupons_history');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('coupons_history').' AUTO_INCREMENT 11');
	}

	public function _currencies() {
		$this->dbforge->drop_table('currencies');

		$fields = array(
			'currency_id INT(11) NOT NULL AUTO_INCREMENT',
			'country_id INT(11) NOT NULL',
			'currency_name VARCHAR(32) NOT NULL',
			'currency_code VARCHAR(3) NOT NULL',
			'currency_symbol VARCHAR(3) NOT NULL',
			'iso_alpha2 VARCHAR(2) NOT NULL',
			'iso_alpha3 VARCHAR(3) NOT NULL',
			'iso_numeric INT(11) NOT NULL',
			'flag VARCHAR(6) NOT NULL',
			'currency_status INT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('currency_id', TRUE);
		$this->dbforge->create_table('currencies');
	}

	public function _customer_groups() {
		$this->dbforge->drop_table('customer_groups');

		$fields = array(
			'customer_group_id INT(11) NOT NULL AUTO_INCREMENT',
			'group_name VARCHAR(32) NOT NULL',
			'description TEXT NOT NULL',
			'approval TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('customer_group_id', TRUE);
		$this->dbforge->create_table('customer_groups');
	}

	public function _customers() {
		$this->dbforge->drop_table('customers');

		$fields = array(
			'customer_id INT(11) unsigned NOT NULL AUTO_INCREMENT',
			'first_name VARCHAR(32) NOT NULL',
			'last_name VARCHAR(32) NOT NULL',
			'email VARCHAR(96) NOT NULL',
			'password VARCHAR(40) NOT NULL',
			'salt VARCHAR(9) NOT NULL',
			'telephone VARCHAR(32) NOT NULL',
			'address_id INT(11) NOT NULL',
			'security_question_id INT(11) NOT NULL',
			'security_answer VARCHAR(32) NOT NULL',
			'newsletter TINYINT(1) NOT NULL',
			'customer_group_id INT(11) NOT NULL',
			'ip_address VARCHAR(40) NOT NULL',
			'date_added DATETIME NOT NULL',
			'status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('customer_id', TRUE);
		$this->dbforge->add_key('email', TRUE);
		$this->dbforge->create_table('customers');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('customers').' AUTO_INCREMENT 11');
	}

	public function _customers_activity() {
		$this->dbforge->drop_table('customers_activity');

		$fields = array(
			'activity_id INT(11) NOT NULL AUTO_INCREMENT',
			'customer_id INT(11) NOT NULL',
			'access_type VARCHAR(128) NOT NULL',
			'browser VARCHAR(128) NOT NULL',
			'ip_address VARCHAR(40) NOT NULL',
			'country_code VARCHAR(2) NOT NULL',
			'request_uri TEXT NOT NULL',
			'referrer_uri TEXT NOT NULL',
			'date_added DATETIME NOT NULL',
			'status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('activity_id', TRUE);
		$this->dbforge->create_table('customers_activity');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('customers_activity').' AUTO_INCREMENT 11');
	}

	public function _extensions() {
		$this->dbforge->drop_table('extensions');

		$fields = array(
			'extension_id INT(11) NOT NULL AUTO_INCREMENT',
			'type VARCHAR(32) NOT NULL',
			'name VARCHAR(128) NOT NULL',
			'data TEXT NOT NULL',
			'serialized TINYINT(1) NOT NULL',
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('extension_id', TRUE);
		$this->dbforge->add_key('type');
		$this->dbforge->add_key('name');
		$this->dbforge->create_table('extensions');
	}

	public function _languages() {
		$this->dbforge->drop_table('languages');

		$fields = array(
			'language_id INT(11) NOT NULL AUTO_INCREMENT',
			'code VARCHAR(7) NOT NULL',
			'name VARCHAR(32) NOT NULL',
			'image VARCHAR(32) NOT NULL',
			'directory VARCHAR(32) NOT NULL',
			'status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('language_id', TRUE);
		$this->dbforge->create_table('languages');
	}

	public function _layout_routes() {
		$this->dbforge->drop_table('layout_routes');

		$fields = array(
			'layout_route_id INT(11) NOT NULL AUTO_INCREMENT',
			'layout_id INT(11) NOT NULL',
			'uri_route VARCHAR(128) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('layout_route_id', TRUE);
		$this->dbforge->create_table('layout_routes');
	}

	public function _layouts() {
		$this->dbforge->drop_table('layouts');

		$fields = array(
			'layout_id INT(11) NOT NULL AUTO_INCREMENT',
			'name VARCHAR(45) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('layout_id', TRUE);
		$this->dbforge->create_table('layouts');
	}

	public function _location_tables() {
		$this->dbforge->drop_table('location_tables');

		$fields = array(
			'location_id INT(11) NOT NULL',
			'table_id INT(11) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('location_id', TRUE);
		$this->dbforge->create_table('location_tables');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('location_tables').' AUTO_INCREMENT 11');
	}

	public function _locations() {
		$this->dbforge->drop_table('locations');

		$fields = array(
			'location_id INT(11) NOT NULL AUTO_INCREMENT',
			'location_name VARCHAR(32) NOT NULL',
			'location_email VARCHAR(96) NOT NULL',
			'description TEXT NOT NULL',
			'location_address_1 VARCHAR(128) NOT NULL',
			'location_address_2 VARCHAR(128) NOT NULL',
			'location_city VARCHAR(128) NOT NULL',
			'location_state VARCHAR(128) NOT NULL',
			'location_postcode VARCHAR(10) NOT NULL',
			'location_country_id INT(11) NOT NULL',
			'location_telephone VARCHAR(32) NOT NULL',
			'location_lat FLOAT(10,6) NOT NULL',
			'location_lng FLOAT(10,6) NOT NULL',
			'location_radius INT(11) NOT NULL',
			'covered_area TEXT NOT NULL',
			'offer_delivery TINYINT(1) NOT NULL',
			'offer_collection TINYINT(1) NOT NULL',
			'ready_time INT(11) NOT NULL',
			'last_order_time INT(11) NOT NULL',
			'delivery_charge DECIMAL(15,2) NOT NULL',
			'min_delivery_total DECIMAL(15,2) NOT NULL',
			'reservation_interval INT(11) NOT NULL',
			'reservation_turn INT(11) NOT NULL',
			'location_status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('location_id', TRUE);
		$this->dbforge->create_table('locations');
	}

	public function _mail_templates() {
		$this->dbforge->drop_table('mail_templates');

		$fields = array(
			'template_id INT(11) NOT NULL AUTO_INCREMENT',
			'name VARCHAR(32) NOT NULL',
			'language_id INT(11) NOT NULL',
			'date_added DATETIME NOT NULL',
			'date_updated DATETIME NOT NULL',
			'status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('template_id', TRUE);
		$this->dbforge->create_table('mail_templates');
	}

	public function _mail_templates_data() {
		$this->dbforge->drop_table('mail_templates_data');

		$fields = array(
			'template_data_id INT(11) NOT NULL AUTO_INCREMENT',
			'template_id INT(11) NOT NULL',
			'code VARCHAR(32) NOT NULL',
			'subject VARCHAR(128) NOT NULL',
			'body TEXT NOT NULL',
			'date_added DATETIME NOT NULL',
			'date_updated DATETIME NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('template_data_id', TRUE);
		$this->dbforge->add_key('template_id', TRUE);
		$this->dbforge->add_key('code', TRUE);
		$this->dbforge->create_table('mail_templates_data');
	}

	public function _menu_options() {
		$this->dbforge->drop_table('menu_options');

		$fields = array(
			'option_id INT(11) NOT NULL AUTO_INCREMENT',
			'option_name VARCHAR(32) NOT NULL',
			'option_price DECIMAL(15,2) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('option_id', TRUE);
		$this->dbforge->create_table('menu_options');
	}

	public function _menus() {
		$this->dbforge->drop_table('menus');

		$fields = array(
			'menu_id INT(11) NOT NULL AUTO_INCREMENT',
			'menu_name VARCHAR(255) NOT NULL',
			'menu_description TEXT NOT NULL',
			'menu_price DECIMAL(15,2) NOT NULL',
			'menu_photo VARCHAR(255) NOT NULL',
			'menu_category_id INT(11) NOT NULL',
			'stock_qty INT(11) NOT NULL',
			'minimum_qty INT(11) NOT NULL',
			'subtract_stock TINYINT(1) NOT NULL',
			'menu_status TINYINT(1) NOT NULL',
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('menu_id', TRUE);
		$this->dbforge->create_table('menus');
	}

	public function _menus_specials() {
		$this->dbforge->drop_table('menus_specials');

		$fields = array(
			'special_id INT(11) NOT NULL AUTO_INCREMENT',
			'menu_id INT(11) NOT NULL DEFAULT "0"',
			'start_date DATE NOT NULL',
			'end_date DATE NOT NULL',
			'special_price DECIMAL(15,2) NOT NULL',
			'special_status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('special_id', TRUE);
		$this->dbforge->add_key('menu_id', TRUE);
		$this->dbforge->create_table('menus_specials');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('menus_specials').' AUTO_INCREMENT 11');
	}

	public function _menus_to_options() {
		$this->dbforge->drop_table('menus_to_options');

		$fields = array(
			'menu_id INT(11) NOT NULL',
			'option_id INT(11) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('menu_id', TRUE);
		$this->dbforge->add_key('option_id', TRUE);
		$this->dbforge->create_table('menus_to_options');
	}

	public function _messages() {
		$this->dbforge->drop_table('messages');

		$fields = array(
			'message_id INT(15) NOT NULL AUTO_INCREMENT',
			'location_id INT(11) NOT NULL',
			'staff_id_from INT(11) NOT NULL',
			'staff_id_to INT(11) NOT NULL',
			'date_added DATETIME NOT NULL',
			'send_type VARCHAR(32) NOT NULL',
			'recipient VARCHAR(32) NOT NULL',
			'subject TEXT NOT NULL',
			'body TEXT NOT NULL',
			'status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('message_id', TRUE);
		$this->dbforge->create_table('messages');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('messages').' AUTO_INCREMENT 11');
	}

	public function _message_recipients() {
		$this->dbforge->drop_table('message_recipients');

		$fields = array(
			'message_recipient_id int(11) NOT NULL AUTO_INCREMENT',
			'message_id int(11) NOT NULL',
			'staff_id int(11) NOT NULL',
			'customer_id int(11) NOT NULL',
			'staff_email varchar(96) NOT NULL',
			'customer_email varchar(96) NOT NULL',
			'state tinyint(1) NOT NULL',
			'status tinyint(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('message_recipient_id', TRUE);
		$this->dbforge->create_table('message_recipients');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('message_recipients').' AUTO_INCREMENT 11');
	}

	public function _orders() {
		$this->dbforge->drop_table('orders');

		$fields = array(
			'order_id int(11) NOT NULL AUTO_INCREMENT',
			'customer_id int(11) NOT NULL',
			'first_name varchar(32) NOT NULL',
			'last_name varchar(32) NOT NULL',
			'email varchar(96) NOT NULL',
			'telephone varchar(32) NOT NULL',
			'location_id int(11) NOT NULL',
			'address_id int(11) NOT NULL',
			'cart text NOT NULL',
			'total_items int(11) NOT NULL',
			'comment text NOT NULL',
			'payment varchar(35) NOT NULL',
			'order_type varchar(32) NOT NULL',
			'date_added datetime NOT NULL',
			'date_modified date NOT NULL',
			'order_time time NOT NULL',
			'order_total decimal(15,2) NOT NULL',
			'status_id int(11) NOT NULL',
			'ip_address varchar(40) NOT NULL',
			'user_agent varchar(255) NOT NULL',
			'notify tinyint(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('order_id', TRUE);
		$this->dbforge->create_table('orders');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('orders').' AUTO_INCREMENT 20011');
	}

	public function _order_menus() {
		$this->dbforge->drop_table('order_menus');

		$fields = array(
			'order_menu_id INT(11) NOT NULL AUTO_INCREMENT',
			'order_id INT(11) NOT NULL',
			'menu_id INT(11) NOT NULL',
			'name VARCHAR(255) NOT NULL',
			'quantity INT(11) NOT NULL',
			'price DECIMAL(15,2) NOT NULL DEFAULT "0.00"',
			'subtotal DECIMAL(15,2) NOT NULL DEFAULT "0.00"',
			'order_option_id INT(11) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('order_menu_id', TRUE);
		$this->dbforge->create_table('order_menus');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('order_menus').' AUTO_INCREMENT 11');
	}

	public function _order_options() {
		$this->dbforge->drop_table('order_options');

		$fields = array(
			'order_option_id INT(11) NOT NULL AUTO_INCREMENT',
			'order_id INT(11) NOT NULL',
			'menu_id INT(11) NOT NULL',
			'option_id INT(11) NOT NULL',
			'option_name VARCHAR(32) NOT NULL',
			'option_price DECIMAL(15,2) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('order_option_id', TRUE);
		$this->dbforge->create_table('order_options');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('order_options').' AUTO_INCREMENT 11');
	}

	public function _order_totals() {
		$this->dbforge->drop_table('order_totals');

		$fields = array(
			'order_total_id INT(11) NOT NULL AUTO_INCREMENT',
			'order_id INT(11) NOT NULL',
			'code VARCHAR(30) NOT NULL',
			'title VARCHAR(255) NOT NULL',
			'value DECIMAL(15,2) NOT NULL',
			'priority TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('order_total_id', TRUE);
		$this->dbforge->add_key('order_id', TRUE);
		$this->dbforge->create_table('order_totals');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('order_totals').' AUTO_INCREMENT 11');
	}

	public function _pages() {
		$this->dbforge->drop_table('pages');

		$fields = array(
			'page_id INT(11) NOT NULL AUTO_INCREMENT',
			'language_id INT(11) NOT NULL',
			'name VARCHAR(32) NOT NULL',
			'title VARCHAR(255) NOT NULL',
			'heading VARCHAR(255) NOT NULL',
			'content TEXT NOT NULL',
			'meta_description VARCHAR(255) NOT NULL',
			'meta_keywords VARCHAR(255) NOT NULL',
			'layout_id INT(11) NOT NULL',
			'menu_location TINYINT(11) NOT NULL',
			'date_added DATETIME NOT NULL',
			'date_updated DATETIME NOT NULL',
			'status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('page_id', TRUE);
		$this->dbforge->create_table('pages');
	}

	public function _permalinks() {
		$this->dbforge->drop_table('permalinks');

		$fields = array(
			'permalink_id INT(11) NOT NULL AUTO_INCREMENT',
			'permalink VARCHAR(255) NOT NULL',
			'query VARCHAR(255) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('permalink_id', TRUE);
		$this->dbforge->create_table('permalinks');
	}

	public function _pp_payments() {
		$this->dbforge->drop_table('pp_payments');

		$fields = array(
			'transaction_id VARCHAR(19) NOT NULL',
			'order_id INT(11) NOT NULL',
			'customer_id INT(11) NOT NULL',
			'serialized TEXT NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('transaction_id', TRUE);
		$this->dbforge->create_table('pp_payments');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('pp_payments').' AUTO_INCREMENT 11');
	}

	public function _reservations() {
		$this->dbforge->drop_table('reservations');

		$fields = array(
			'reservation_id INT(32) NOT NULL AUTO_INCREMENT',
			'location_id INT(11) NOT NULL',
			'table_id INT(11) NOT NULL',
			'guest_num INT(11) NOT NULL',
			'occasion_id INT(11) NOT NULL',
			'customer_id INT(11) NOT NULL',
			'first_name VARCHAR(45) NOT NULL',
			'last_name VARCHAR(45) NOT NULL',
			'email VARCHAR(96) NOT NULL',
			'telephone VARCHAR(45) NOT NULL',
			'comment TEXT NOT NULL',
			'reserve_time TIME NOT NULL',
			'reserve_date DATE NOT NULL',
			'date_added DATE NOT NULL',
			'date_modified DATE NOT NULL',
			'staff_id INT(11) NOT NULL',
			'notify TINYINT(1) NOT NULL',
			'ip_address VARCHAR(40) NOT NULL',
			'user_agent VARCHAR(255) NOT NULL',
			'status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('reservation_id', TRUE);
		$this->dbforge->add_key('location_id', TRUE);
		$this->dbforge->add_key('table_id', TRUE);
		$this->dbforge->create_table('reservations');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('reservations').' AUTO_INCREMENT 20011');
	}

	public function _reviews() {
		$this->dbforge->drop_table('reviews');

		$fields = array(
			'review_id INT(11) NOT NULL AUTO_INCREMENT',
			'customer_id INT(11) NOT NULL',
			'order_id INT(11) NOT NULL',
			'author VARCHAR(32) NOT NULL',
			'location_id INT(11) NOT NULL',
			'quality INT(11) NOT NULL',
			'delivery INT(11) NOT NULL',
			'service INT(11) NOT NULL',
			'review_TEXT TEXT NOT NULL',
			'date_added DATETIME NOT NULL',
			'review_status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('review_id', TRUE);
		$this->dbforge->add_key('order_id', TRUE);
		$this->dbforge->create_table('reviews');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('reviews').' AUTO_INCREMENT 11');
	}

	public function _security_questions() {
		$this->dbforge->drop_table('security_questions');

		$fields = array(
			'question_id INT(11) NOT NULL AUTO_INCREMENT',
			'text TEXT NOT NULL',
			'priority TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('question_id', TRUE);
		$this->dbforge->create_table('security_questions');
	}

	public function _settings() {
		$this->dbforge->drop_table('settings');

		$fields = array(
			'setting_id INT(11) NOT NULL AUTO_INCREMENT',
			'sort VARCHAR(45) NOT NULL',
			'item VARCHAR(255) NOT NULL',
			'value TEXT NOT NULL',
			'serialized TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('setting_id', TRUE);
		$this->dbforge->add_key('item');
		$this->dbforge->create_table('settings');
	}

	public function _staff_groups() {
		$this->dbforge->drop_table('staff_groups');

		$fields = array(
			'staff_group_id INT(11) NOT NULL AUTO_INCREMENT',
			'staff_group_name VARCHAR(32) NOT NULL',
			'location_access TINYINT(1) NOT NULL',
			'permission TEXT NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('staff_group_id', TRUE);
		$this->dbforge->create_table('staff_groups');
	}

	public function _staffs() {
		$this->dbforge->drop_table('staffs');

		$fields = array(
			'staff_id INT(11) NOT NULL AUTO_INCREMENT',
			'staff_name VARCHAR(32) NOT NULL',
			'staff_email VARCHAR(96) NOT NULL',
			'staff_group_id INT(11) NOT NULL',
			'staff_location_id INT(11) NOT NULL',
			'timezone VARCHAR(32) NOT NULL',
			'language_id INT(11) NOT NULL',
			'date_added DATE NOT NULL',
			'staff_status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('staff_id', TRUE);
		$this->dbforge->create_table('staffs');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('staffs').' AUTO_INCREMENT 11');
	}

	public function _status_history() {
		$this->dbforge->drop_table('status_history');

		$fields = array(
			'status_history_id INT(11) NOT NULL AUTO_INCREMENT',
			'order_id INT(11) NOT NULL',
			'staff_id INT(11) NOT NULL',
			'assigned_id INT(11) NOT NULL',
			'status_id INT(11) NOT NULL',
			'notify TINYINT(1) NOT NULL',
			'status_for VARCHAR(32) NOT NULL',
			'comment TEXT NOT NULL',
			'date_added DATETIME NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('status_history_id', TRUE);
		$this->dbforge->create_table('status_history');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('status_history').' AUTO_INCREMENT 11');
	}

	public function _statuses() {
		$this->dbforge->drop_table('statuses');

		$fields = array(
			'status_id INT(15) NOT NULL AUTO_INCREMENT',
			'status_name VARCHAR(45) NOT NULL',
			'status_comment TEXT NOT NULL',
			'notify_customer TINYINT(1) NOT NULL',
			'status_for VARCHAR(10) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('status_id', TRUE);
		$this->dbforge->create_table('statuses');
	}

	public function _tables() {
		$this->dbforge->drop_table('tables');

		$fields = array(
			'table_id INT(11) NOT NULL AUTO_INCREMENT',
			'table_name VARCHAR(32) NOT NULL',
			'min_capacity INT(11) NOT NULL',
			'max_capacity INT(11) NOT NULL',
			'table_status TINYINT(1) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('table_id', TRUE);
		$this->dbforge->create_table('tables');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('tables').' AUTO_INCREMENT 11');
	}

	public function _uri_routes() {
		$this->dbforge->drop_table('uri_routes');

		$fields = array(
			'uri_route_id INT(11) NOT NULL AUTO_INCREMENT',
			'uri_route VARCHAR(255) NOT NULL',
			'controller VARCHAR(128) NOT NULL',
			'priority TINYINT(11) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('uri_route_id', TRUE);
		$this->dbforge->add_key('uri_route', TRUE);
		$this->dbforge->create_table('uri_routes');
	}

	public function _users() {
		$this->dbforge->drop_table('users');

		$fields = array(
			'user_id INT(11) NOT NULL AUTO_INCREMENT',
			'staff_id INT(11) NOT NULL',
			'username VARCHAR(32) NOT NULL',
			'password VARCHAR(40) NOT NULL',
			'salt VARCHAR(9) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->add_key('staff_id', TRUE);
		$this->dbforge->add_key('username', TRUE);
		$this->dbforge->create_table('users');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('users').' AUTO_INCREMENT 11');
	}

	public function _working_hours() {
		$this->dbforge->drop_table('working_hours');

		$fields = array(
			'location_id INT(11) NOT NULL',
			'weekday INT(11) NOT NULL',
			'opening_time TIME NOT NULL DEFAULT "00:00:00"',
			'closing_time TIME NOT NULL DEFAULT "00:00:00"'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('location_id', TRUE);
		$this->dbforge->add_key('weekday', TRUE);
		$this->dbforge->create_table('working_hours');

		$this->db->query('ALTER TABLE '.$this->db->dbprefix('working_hours').' AUTO_INCREMENT 11');
	}
}

/* End of file 001_schema.php */
/* Location: ./application/extensions/setup/migrations/001_schema.php */