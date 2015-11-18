<?php
class SlideshowModel
{
    /**----- Install plug-in, create database.
     *
     * @since 1.0.0
     *
     * @var $this->table
     * @var $this->version
     * @action register_activation_hook
    */
    public function install()
    {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta("
            CREATE TABLE IF NOT EXISTS {$this->table} (
                id        	int(3) NOT NULL AUTO_INCREMENT,
                file     	varchar(155) NOT NULL,
                title     	varchar(255) NOT NULL,
                alt       	varchar(255) NOT NULL,
                link       	varchar(255) NOT NULL,
                buttons   	text NOT NULL,
                color		varchar(255) NOT NULL,
                rang		int(3) NOT NULL,
                hideOverlying enum('Y','N') DEFAULT 'N',
                PRIMARY KEY  (id),
                UNIQUE KEY id (id)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
        ");

        add_option('jrwd_slideshow_settings', '', '', 'yes');
    }


	/**----- De-install plug-in, delete options.
	 *
	 * @since 1.0.0
	 *
	 * @var $this->table
	 * @action register_deactivation_hook
	 */
    public function uninstall()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS {$this->table}");

        delete_option('jrwd_slideshow_settings');
    }


	/**----- Execute any database query.
	 *
	 * @since 1.0.0
	 *
	 * @param string $query ~ Containing the whole query to execute
	 */
	public function dbQuery($query)
	{
		$this->wpdb->query($query);
	}


    /**----- Get single item from database.
     *
     * @since 1.0.0
     *
     * @param   int $id Required. Selector for database item
     * @param   string $table String of the table to use for query
     *
     * @return  array   Create array from database row
     */
    public function getItem($id, $table = null)
    {
	    $table = isset($table) ? $this->table.$table : $this->table;

        return $this->wpdb->get_row(
            $this->wpdb->prepare("
                SELECT  *
                FROM    {$table}
                WHERE   id = %s
            ", $id)
        );
    }


	/**----- Get all item from the database.
	 *
	 * @since 1.0.0
	 *
	 * @param   string $table ~ String of the table to use for query
	 * @param   string $order ~ Contains string to sort SQL
	 * @param   array $where ~ Create a WHERE statement in the query
	 *
	 * @return  object ~ Creates object from multiple database rows
	 */
	public function getAll($table = null, $order = null, $where = null)
	{
		$table = isset($table) ? $this->table.$table : $this->table;

		$append = null;
		if (isset($where)) {
			foreach ($where as $key => $val)
				$append .= " AND `{$key}` = '{$val}'";
		}

		if (isset($order))
			$order = 'ORDER BY '. $order;

		return $this->wpdb->get_results("
            SELECT  *
            FROM    {$table}
            WHERE   id ". $append ."
            {$order}
        ");
	}


	/**----- Add item to the database.
	 *
	 * @since 1.0.0
	 *
	 * @param   array $values ~ Required. Array of elements in $_POST object
	 * @param   string $table ~ String of the table to use for query
	 */
	public function addItem($values, $table = null)
	{
		$table = isset($table) ? $this->table.$table : $this->table;

        $this->wpdb->query(
            $this->wpdb->prepare("
                INSERT
                INTO    $table (title, alt, file, hideOverlying, color, buttons, rang, link)
                VALUES  (%s, %s, %s, %s, %s, %s, %s, %s)
            ", $values)
        );
    }


	/**----- Edit existing row from the database.
	 *
	 * @since 1.0.0
	 *
	 * @param   int $id ~ Required. ID of the database row to edit
	 * @param   string $table ~ String of the table to use for query
	 * @param   array $values ~ Required. Array of elements in $_POST object
	 *
	 */
	public function editItem($id, $values, $table = null)
	{
		$table = isset($table) ? $this->table.$table : $this->table;
		$this->wpdb->update($table, $values, array('id' => $id));
	}


	/**----- Delete row in the database.
	 *
	 * @since 1.0.0
	 *
	 * @param   int $id ~ Required. ID of the database row to delete
	 * @param   string $table ~ String of the table to use for query
	 */
	public function deleteItem($id, $table = null)
	{
		$table = isset($table) ? $this->table.$table : $this->table;

		$this->wpdb->query(
			$this->wpdb->prepare("
                DELETE
                FROM    {$table}
                WHERE   id = %s
            ", $id)
		);
	}
}