<?php
/**
 * @author jambonbill
 */

namespace Minitel;

use PDO;
use Exception;
use Djang\Base;

/**
 * Minitel page (vdt)
 */
class Page
{
	private $_Base;
	private $_user;
    private $_DEBUG=false;

	public function __construct (Base $Base)
    {
        $this->_Base=$Base;
    }

    public function db()
    {
    	return $this->_Base->db();
    }

    public function _uid()
    {
    	return $this->_Base->userId();
    }


    /**
     * Return list of pages
     * @return [type] [description]
     */
    public function list()
    {

    }

    public function create(string $name,strin $b64data)
    {

    }

    public function update()
    {

    }

    public function delete(int $id)
    {

    }

}