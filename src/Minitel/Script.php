<?php
/**
 * @author jambonbill
 */

namespace Minitel;

use PDO;
use Exception;
use Djang\Base;
/**
 * Minitel script (miniscript)
 */
class Script
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
     * Return one script record
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function get(int $id)
    {
        $sql="SELECT * FROM `minitel`.`script` WHERE id=$id LIMIT 1;";
        $q=$this->db()->query($sql) or die(print_r($this->db()->errorInfo(), true) . "<hr />$sql");

        $r=$q->fetch(PDO::FETCH_ASSOC);
        return $r;

    }


    /**
     * Return list of scripts
     * @return [type] [description]
     */
    public function list()
    {
    	$sql="SELECT id, name FROM `minitel`.`script` WHERE id>0;";
    	$q=$this->db()->query($sql) or die(print_r($this->db()->errorInfo(), true) . "<hr />$sql");

        $dat=[];
        while($r=$q->fetch(PDO::FETCH_ASSOC)){
            $dat[]=$r;
        }
        return $dat;
    }


    /**
     * Create a script
     * @param  string $name    [description]
     * @param  string $b64data [description]
     * @return [type]          [description]
     */
    public function create(string $name, string $data)
    {
        if(!$name){
            throw new Exception("Error Processing script name", 1);
        }

    	$sql ="INSERT INTO `minitel`.script (name, data, created_at, created_by) ";
    	$sql.="VALUES (".$this->db()->quote($name).", ".$this->db()->quote($data).", NOW(), ".$this->_uid().");";

        $q=$this->db()->query($sql) or die(print_r($this->db()->errorInfo(), true) . "<hr />$sql");
    	$id=$this->db()->lastInsertId();

        if (!$id) {
            return false;
        }

    	return $id;
    }


    /**
     * array data is typically '_POST'
     * @param  int    $id   [description]
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public function update(int $id, array $data)
    {
    	if (!$id) {
    		throw new Exception("Error Processing Request", 1);
    	}

        $sql ="UPDATE `minitel`.script SET updated_at=NOW() ";
        $sql.=", data=".$this->db()->quote($data['data']);
        $sql.=" WHERE id=$id LIMIT 1;";

        $q=$this->db()->query($sql) or die(print_r($this->db()->errorInfo(), true) . "<hr />$sql");

        return $id;
    }

    /**
     * Delete a minitel script
     * @param  int    $id [description]
     * @return [type]     [description]
     */
    public function delete(int $id)
    {
    	if (!$id) {
    		throw new Exception("Error Processing Request", 1);
    	}

    	$sql="UPDATE minitel.script SET id=-id WHERE id=$id LIMIT 1;";
    	$q=$this->db()->query($sql) or die("Error:$sql");
        return $id;
    }

}