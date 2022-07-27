<?php
    include('config.php');
    class db extends mysqli {

        // single instance of self shared among all instances
        private static $instance = null;

        // db connection config vars
        private $user = DBUSER;
        private $pass = DBPWD;
        private $dbName = DBNAME;
        private $dbHost = DBHOST;
        public $prefix = PREFIX;

        //This method must be static, and must return an instance of the object if the object
        //does not already exist.
        public static function getInstance() {
        if (!self::$instance instanceof self) {
                self::$instance = new self;
        }
            return self::$instance;
        }

        // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
        // thus eliminating the possibility of duplicate objects.
        public function __clone() {
       trigger_error('Clone is not allowed.', E_USER_ERROR);
        }
		
        public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
        }

        private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');

       }
	   
       public function dbquery($query)
        {
            if($this->query($query))
            {
                return true;
            }
        }
		
        public function get_result($query) 
        {
            $result = $this->query($query);
            if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
            } else
            return null;
        }
		
        public function get_product_results($query) 
        {
            $result = $this->query($query);
            if ($result->num_rows > 0){
            //$row = $result->fetch_assoc();
         	$i = 0;
			$rows = array();
			while ($row = $result->fetch_assoc()) {
            $rows[$i] = array($row["id"],$row["product"],$row["description"],$row["active"],$row["isSub"],$row["SubT"]);
            $i++;
         	}
            return $rows;
            } else
            return null;
        }
		
        public function get_multiuser_results($query) 
        {
            $result = $this->query($query);
            if ($result->num_rows > 0){
            //$row = $result->fetch_assoc();
         	$i = 0;
			$rows = array();
			while ($row = $result->fetch_assoc()) {
            $rows[$i] = array($row["id"],$row["username"],$row["active"],$row["license"]);
            $i++;
         	}
            return $rows;
            } else
            return null;
        }
		
        public function get_user_results($query) 
        {
            $result = $this->query($query);
            if ($result->num_rows > 0){
            //$row = $result->fetch_assoc();
         	$i = 0;
			$rows = array();
			while ($row = $result->fetch_assoc()) {
            $rows[$i] = array($row["id"],$row["username"],$row["email"],$row["active"]);
            $i++;
         	}
            return $rows;
            } else
            return null;
        }
		
        public function get_multiuser_result($query) 
        {
            $result = $this->query($query);
            if ($result->num_rows > 0){
            //$row = $result->fetch_assoc();
         	$i = 0;
			$rows = array();
			while ($row = $result->fetch_assoc()) {
            $rows[$i] = array($row["id"],$row["username"],$row["password"],$row["active"]);
            $i++;
         	}
            return $rows;
            } else
            return null;
        }
		
        public function get_user_result($query) 
        {
            $result = $this->query($query);
            if ($result->num_rows > 0){
            //$row = $result->fetch_assoc();
         	$i = 0;
			$rows = array();
			while ($row = $result->fetch_assoc()) {
            $rows[$i] = array($row["id"],$row["username"],$row["password"],$row["email"],$row["active"]);
            $i++;
         	}
            return $rows;
            } else
            return null;
        }
		
        public function get_licenses_results($query) 
        {
            $result = $this->query($query);
            if ($result->num_rows > 0){
            //$row = $result->fetch_assoc();
         	$i = 0;
			$rows = array();
			while ($row = $result->fetch_assoc()) {
            $rows[$i] = array($row["id"],$row["prodID"],$row["uid"],$row["license"],$row["isMultiUser"],$row["MaxMultiUser"]);
            $i++;
         	}
            return $rows;
            } else
            return null;
        }
		
        public function get_license_result($query) 
        {
            $result = $this->query($query);
            if ($result->num_rows > 0){
            //$row = $result->fetch_assoc();
         	$i = 0;
			$rows = array();
			while ($row = $result->fetch_assoc()) {
            $rows[$i] = array($row["id"],$row["prodID"],$row["uid"],$row["license"],$row["active"],$row["isSub"],$row["SubT"],$row["startDate"],$row["endDate"],$row["lastChecked"],$row["isMultiUser"],$row["MaxMultiUser"]);
            $i++;
         	}
            return $rows;
            } else
            return null;
        }
    }
?>