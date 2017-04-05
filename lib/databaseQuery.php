<?php

defined("BASEURL") or die("Direct access denied");

/**
 * @name Database query class
 * --------------------------------------------------------------------
 * @author: Sab-Udeh Chukwumdimma K.J
 * 
 *
 * @package: Library of  Mysql PDO database prepared queries.
 *
 * @copyright 2016
 *
 * @return Fetch data and return in array / Executes query commands. / Return last inserted id
 *
 * @access public
 *
 *
 *  @see coreModel class for @example on how to instantiate dbQuery. 
 * 
 * @uses read dbQuery method documentations to learn how to use each methods.
 * 
 * /--------------------------------------------------------------/
 * /                              WARNING!                         /
 * /--------------------------------------------------------------/ 
 * /    Before adding a new method, confirm that the query        /
 * /             you need has not been written already             /
 * /--------------------------------------------------------------/
 **/

/**
 * dbQuery
 * 
 * @package 
 * @author chu chu
 * 
 * @version $Id$
 * 
 */
class dbQuery
{
    private $db;
    private $stmt;
    private $table;
    private $result;
    private $returns;
    private $bindData;
    private $logicalType;
    private $executeType;
    private $lastInsertId;

    /**
     * dbQuery::__construct()
     * 
     * @return
     */
    public function __construct()
    {
        $this->db = dataBase::getDatabase()->getConnection(); //db Instance (From config/database.php)

        $this->stmt = ""; // Takes in query strings.
        $this->table = ""; // Store the current requested table.
       // $this->returns = []; // Store in Array fetched values.
        $this->bindData = []; // Stores in Array data to be bind.
        $this->logicalType = ""; // stores Logic use in query with LIKE operator
        $this->executeType = ""; // Takes in the db execution query type @example (INSERT, DELETE, UPDATE);
        $this->lastInsertId = ""; // Stores the last inserted id of user when INSERT query is executed
    }

    /**
     * @package Select Method
     *-------------------------------------------------------------------------------/
     * @category: FETCH                                                             /
     * @access public                                                               
     * @uses: Method gets the columns that is needed in the select query            /
     * @param: Parameters expected to be passed in array @see @example              /
     * @return: return into variable, a query of column selected.                   /
     *-------------------------------------------------------------------------------/
     * @example: $db->select(["column_1, column_2, etc..."])                        /
     * @abstract: When no array @param is passed, method selects in wiled card(*)   /
     ********************************************************************************/
    /**
     * dbQuery::select()
     * 
     * @param mixed $columns
     * @return
     */
    public function select($columns = [])
    {
        $stmt = "SELECT ";
        if (empty($columns))
        {
            $stmt .= "*";
        } else
        {
            $columns = $this->commaPrefix($columns);
            $stmt .= sprintf("%s", $columns);
        }
            
        $this->stmt = $stmt;
        return $this;
    }

    public function selectCount($column) {
        $stmt = "SELECT COUNT(".$column.")";
        $this->stmt = $stmt;
        return $this;
    }

    /**
     * @package From Method
     *---------------------------------------------------------------/
     * @category: FETCH.                                            /
     * @access public                                               
     * @uses: Method select the table needed in select query.       /
     * @param: Takes in Table name.                                 /
     * @return: passes into variable, a query of table selected.        /
     *---------------------------------------------------------------/
     * @example: $db->select()->from("table name")->fetch()         /
     ****************************************************************/
    /**
     * dbQuery::from()
     * 
     * @param mixed $table
     * @return
     */
    public function from($table)
    {
        $stmt = " FROM ";
        $this->stmt .= $stmt . sprintf("%s", $table);
        return $this;
    }

    /**
     * @package In Method
     *--------------------------------------------------------------------------------------------------/
     * @category: FETCH                                                                                 /
     * @access public                                                                                   
     * @uses: Method help in matching multiple values in a single column                                /
     * @param: Takes two parameter: column_name and in array rows inside the column                     /
     * @return: passes into variable, a query containing column name and values to select from column.  /
     *--------------------------------------------------------------------------------------------------/
     * @example: $db->select()->from->()->in("column_Name", ["var_1, var_2, etc..."])->fetch();         /
     ***************************************************************************************************/
    /**
     * dbQuery::in()
     * 
     * @param mixed $column
     * @param mixed $values
     * @return
     */
    public function in($column, $values = [])
    {
        $stmt = " WHERE $column IN (";
        $values = $this->commaStringPrefix($values);
        $this->stmt .= $stmt . sprintf("%s", $values) . ")";
        return $this;
    }

    /**
     * @package where Method
     *---------------------------------------------------------------------------------------------------/
     * @category FETCH and EXECUTE                                                                      /
     * @access public                                                                                   
     * @uses: Method help in narrowing down a query to a particular column value using a WHERE clause.  /
     * @param: Takes in an associative array of name of column and the value to limit the query             /
     * @return: Send @param to a setData method for binding preparation.                                /
     *---------------------------------------------------------------------------------------------------/
     * @example: $db->select()->from()->where(["column_Name"=>value_Name])->fetch();                    /
     * @example:    $db->saveTo()->where([array_assoc])->execute();                                         /
     * @abstract: Can be called multiple times when a query require multiple WHERE clauses.                 /
     ****************************************************************************************************/
    /**
     * dbQuery::where()
     * 
     * @param mixed $where
     * @return
     */
    public function where($where = [])
    {
        $cond = " WHERE ";
        return $this->setData($cond, $where);
    }

    /**
     * @package condition(cond) Method
     *---------------------------------------------------------------------------------------------------------------------------/
     * @category FETCH AND EXECUTE                                                                                              /
     * @access public                                                                                                           
     * @uses: Method is use in conjunction with where method  when an additional clause is requires like (AND, OR);                 /
     * @param: Takes two parameters, The condition type and in associative array the column name and the value to limit query   /
     * @return: Send to setData method for binding preparation.                                                                     /
     *---------------------------------------------------------------------------------------------------------------------------/
     * @example: $db->select()->from()->where()->cond("cond_type", ["column_NAme"="value"])->fetch();                           /
     * @abstract: Can be called multiple times when a query require multiple AND or OR clauses.                                     /
     ****************************************************************************************************************************/
    /**
     * dbQuery::cond()
     * 
     * @param mixed $condType
     * @param mixed $columns
     * @return
     */
    public function cond($condType, $columns = [])
    {
        static $i = 0;

        switch (strtoupper($condType))
        {
            case 'AND':
                $type = " " . $condType . " ";
                break;
            case 'OR':
                $type = " " . $condType . " ";
                break;

            default:
                # code...
                break;
        }
        $new_key = array();
        $new_value = array();
        foreach ($columns as $key => $value) {
            array_push($new_key, $key."_____".$i);
            array_push($new_value, $value);
        }

        $data = array_combine($new_key, $new_value);

        ++$i;
        return $this->setData(strtoupper($type), $data);
    }

    /**
     * @package Like Method
     *-------------------------------------------------------------------------------------------------------------------/
     * @category FETCH (search).                                                                                        /
     * @access public                                                                                                   
     * @uses: Use for search queries                                                                                    /
     * @param: Takes three parameter: Column to search, what to search and how to match search.                             /
     * @return: A search query string.                                                                                  /
     *-------------------------------------------------------------------------------------------------------------------/
     * @example $db->select()->from()->like("column_Name", ["search_Match"=>"search_Match"], "type")->fetch()           /
     * @abstract @param must be in associative array. When @var $type is left blank, query for 'both' is executed        /
     ********************************************************************************************************************/
    /**
     * dbQuery::like()
     * 
     * @param mixed $column
     * @param mixed $param
     * @param string $type
     * @return
     */
    public function like($column, $param, $type = "")
    {
        switch ($this->logicalType)
        {
            case 'OR': // the same code with AND

            case 'AND':
                $stmt = sprintf("%s", $column) . " LIKE ";
                break;

            default:
                $stmt = " WHERE " . sprintf("%s", $column) . " LIKE ";
                break;
        }

        foreach ($param as $key => $keyword)
        {
            $key = sprintf("%s", $key);
            switch (strtolower($type))
            {
                case 'start':
                    $keyword = sprintf("%s", "%" . $keyword);
                    break;

                case 'end':
                    $keyword = sprintf("%s", $keyword . "%");
                    break;

                case 'both': // Default

                default:
                    $keyword = sprintf("%s", "%" . $keyword . "%");
                    break;
            }
            $this->bindData[$key] = $keyword;
            $this->stmt .= $stmt . " :$key";
        }
        return $this;
    }

    /**
     * @package Like logical Operator Method 
     * ----------------------------------------------------------------------------------/
     * @category: FETCH (Like Method)                                                   /
     * @access public                                                                   
     * @uses Must only be use with like Method when additional condition is requires.   /
     * @param: Take logical operator type                                               /
     *-----------------------------------------------------------------------------------/
     * @example $db->select()->like()->logicalOpt($type)->like()->fetch();              /
     ************************************************************************************/
    /**
     * dbQuery::logicalOpt()
     * 
     * @param mixed $type
     * @return
     */
    public function logicalOpt($type)
    {
        switch (strtoupper($type))
        {
            case 'OR':
                $stmt = " OR ";
                $this->logicalType = "OR";
                break;

            case 'AND':
                $stmt = " AND ";
                $this->logicalType = "AND";
                break;

            default:

                break;
        }
        $this->stmt .= $stmt;
        return $this;
    }


    /**
     * @package natural join Method
     *------------------------------------------------------------------------------/
     * @category: FETCH.    (Joining Tables).                                          /
     * @access public                                                              
     * @uses Method is use when joining two or more tables using NATURAL JOIN       /
     * @param: Takes table name only.                                              /
     *------------------------------------------------------------------------------/
     * @example $db->select()->from()->nJoin(table_Name)->fetch()                   /
     * @abstract To specify column when Natural joining, use Where Method           /
     *  @example ....->nJoin()->where()->fetch();                                  /
     *******************************************************************************/
    /**
     * dbQuery::nJoin()
     * 
     * @param mixed $table
     * @return
     */
    public function nJoin($table)
    {
        $stmt = " NATURAL JOIN " . sprintf("%s", $table);
        $this->stmt .= $stmt;
        return $this;
    }

    /**
     * @package Join Method
     *------------------------------------------------------------------------------------------/
     * @category: FETCH.    (Joining Tables).                                                      /
     * @access public                                                                          
     * @uses Method is use when joining two or more tables using any type of join               /
     * @param: Takes in array table name and the type of join                                  /
     *------------------------------------------------------------------------------------------/
     * @example $db->select()->from()->Join([table_Name, etc..], "join_Type")->on()->fetch()    /
     * @abstract types of join: (JOIN or (INNER JOIN), LEFT JOIN, RIGHT JOIN, FULL OUTER JOIN)  /
     *  Also join Method must be use with (on method) as @see in the example                   /
     *******************************************************************************************/
    /**
     * dbQuery::join()
     * 
     * @param mixed $table
     * @param mixed $jointype
     * @return
     */
    public function join($table, $jointype)
    {
        $stmt = " " . strtoupper($jointype) . " ";
        $stmt .= $this->commaPrefix($table);
        $this->stmt .= $stmt;
        return $this;
    }

    /**
     * @package On Method
     *------------------------------------------------------------------------------------------/
     * @category: FETCH (Joining Tables).                                                      /
     * @access public                                                                          
     * @uses: Method is use in conjuction with Join method to specify the joint connection.     /
     * @param: Takes two parameters; The two table column connections.                         /
     *------------------------------------------------------------------------------------------/
     * @example: $db->select()->from()->join()->on(table1.column1, table2.column2)->fetch()    /
     * @abstract: On Method can never be used without calling (join method) as @see in example  /
     *******************************************************************************************/
    /**
     * dbQuery::on()
     * 
     * @param mixed $cond1
     * @param mixed $cond2
     * @return
     */
    public function on($cond1, $cond2)
    {
        $stmt = " ON ";
        $stmt .= sprintf("%s", $cond1) . "=" . sprintf("%s", $cond2);

        $this->stmt .= $stmt;
        return $this;
    }

    /**
     * @package orderBy Method
     *--------------------------------------------------------------------------------------------------------------------/
     * @category: FETCH.                                                                                                  /
     * @access public                                                                                                 
     * @user: Method is use to sort data return by fetch query.                                                           /
     * @param: Takes two parameters: column name and type of order(either decending or ascending order).                  /
     *--------------------------------------------------------------------------------------------------------------------/
     * @example: $db->select()->from()->orderBy->(columName, "ASC")->fetch();                                             /
     * @abstract: This method can be use in any fetch query and must be added just before fetch method as @see in example / 
     **********************************************************************************************************************/
    /**
     * dbQuery::orderBy()
     * 
     * @param mixed $order
     * @param string $orderType
     * @return
     */
    public function orderBy($order, $orderType = "")
    {
        $stmt = " ORDER BY ";

        switch (strtoupper($orderType))
        {
            case 'DESC':
                $stmt .= sprintf("%s", $order) . " $orderType";
                break;

            case 'ASC': // Default

            default:
                $stmt .= sprintf("%s", $order) . " ASC";
                break;
        }
        $this->stmt .= $stmt;
        return $this;
    }

    /**
     * @package Limit method
     * ---------------------------------------------------------------------------/
     * @category: FETCH.                                                          /
     * @access public                                                          
     * @uses: Method use for limiting fetch query results.                        /
     * @param: Takes two params in integer, Minumum and maximun.                  /
     * ---------------------------------------------------------------------------/
     * @example: $db->select()->from()->limit(2, 3)->fetch()                      /
     * @abstract: Method can also be used in conjuction with other fetch queries  /
     *****************************************************************************/
    /**
     * dbQuery::limit()
     * 
     * @param mixed $min
     * @param string $max
     * @return
     */
    public function limit($min, $max = "")
    {
        $max !== "" ? $this->stmt .= " LIMIT " . intval((int)$min) . ", " . intval((int)$max) : $this->
            stmt .= " LIMIT " . intval($min);
        return $this;
    }

    /**
     * @package: saveInto Method
     * -----------------------------------------------------------------------------------------------------------/
     * @category: EXECUTE.                                                                                        /
     * @access public                                                                                          
     * @uses: Method use for passing data to database.                                                            /
     * @param: Takes three params, The table name, in array data to save, and the type of query.(INSERT, UPDATE)  /
     * -----------------------------------------------------------------------------------------------------------/
     * @example: $db->saveInto(tableName, [":columnName2"=>$data1, ":columnName2"=>data2], "INSERT")->exectue()   /
     * @example $db->saveInto(tableName, ["columnName2"=>$data1, "columnName2"=>data2], "UPDATE")->exectue()      /
     * @abstract: When runing an INSERT, Alwas prefix the array keys with(:) as @see in example                   /
     *************************************************************************************************************/
    /**
     * dbQuery::saveInto()
     * 
     * @param mixed $table
     * @param mixed $data
     * @param mixed $type
     * @return
     */
    public function saveInto($table, $data, $type)
    { 
        $this->table = sprintf("%s", $table);
        $this->executeType = strtoupper($type);
        $this->stmt = "";
        return $this->setData("", $data);
    }


    /**
     * @package: Delete Method
     * -------------------------------------------------------/
     * @category: EXECUTE.                                    /
     * @access public                                   
     * @uses: Method use for deleting data from database.     /
     * @param: Takes only the table name you want to delete   /
     * -------------------------------------------------------/
     * @example: $db->delete(tableName)->where()->exectue()   /
     *********************************************************/
    /**
     * dbQuery::delete()
     * 
     * @param mixed $table
     * @return
     */
    public function delete($table)
    {
        $this->executeType = "DELETE";
        $stmt = "DELETE FROM $table";
        $this->stmt = $stmt;
            
        return $this;
    }

    /**
     * @package: Fetch Method
     * ----------------------------------------------------------/
     * @category: FETCH.                                         /
     * @access public                                          
     * @uses: Use to execute all fetch queries.                  /
     * @param: takes in two boolen parameters as optional        /
     * ----------------------------------------------------------/
     * @example: $db->select()->from->()->fetch(FALSE, FALSE)    /
     * @abstract:
     ************************************************************/
    /**
     * dbQuery::fetch()
     * 
     * @param bool $fetchType
     * @param bool $arrayType
     * @return
     */
    public function fetch($fetchType = false, $arrayType = false)
    {
        $returnData = [];
        $dataArray = [];

        $fetch = "fetch";
        if ($fetchType == true)
        {
            $fetch = "fetchAll";
        }

        try
        {
            $this->result = $this->db->prepare($this->stmt);
           
            unset($this->stmt); // Clear query statements

            
            if (isset($this->bindData))
            {
                $dataArray = $this->bindData;
                unset($this->bindData); // clear bind data values
            }
            foreach ($dataArray as $key => $value)
            {
                $this->bind($key, $value);
            }
           
            $this->result->execute();

            if ($arrayType == true) {
                while ($row = $this->result->$fetch(PDO::FETCH_NUM)) {
                   array_push($returnData, $row);
                }
            }
             else {
                while ($row = $this->result->$fetch()) {
                    array_push($returnData, $row);
                }
            }

            $result = $returnData;

            unset($returnData); // clear return data
            unset($this->result); // Clear Results data

            return $result;

           
        }
        catch (PDOException $e)
        {
            die("Error! " . $e->getMessage());
        }
    }

    /**
     * @package: Fetch Method
     * --------------------------------------------------------/
     * @category: EXECUTE.                                     /
     * @access public                                        
     * @uses: Use ro execute all none fetch queries.           /
     * @param: takes in two boolen parameters as optional      /
     **********************************************************/
    /**
     * dbQuery::execute()
     * 
     * @return
     */
    public function execute()
    {
        
        
        $data = $this->commaPrefix(array_keys($this->bindData));
            
        $dataArray = [];

       // try
        //{
            

            switch ($this->executeType)
            {
                case "INSERT":
                    $this->result = $this->db->prepare("INSERT INTO " . $this->table . " VALUES($data)");
                    break;

                case "UPDATE":
                    $this->result = $this->db->prepare("UPDATE " . $this->table . " SET " . $this->stmt . "");
                    break;

                case "DELETE":
                    $this->result = $this->db->prepare($this->stmt);
                    break;

                default:
                    # code...
                    break;
            }

            unset($this->stmt); // Clear Statement

            if ($this->bindData)
            {
                $dataArray = $this->bindData;
                unset($this->bindData); // Clear bindData Values
            }

            foreach ($dataArray as $key => $value)
            {
                $this->bind($key, $value);
            }
                
            $this->result->execute();


            unset($this->result); // Clear Results data

            if ($this->executeType == "INSERT") {
                $this->lastInsertId = $this->db->lastInsertId();
            }

            
       // }
        //catch (PDOException $e)
        //{

          //  die("Error! " . $e->getMessage());
        //}
    }

    // Get Last insert id
    /**
     * dbQuery::getLastInsertId()
     * 
     * @return
     */
    public function getLastInsertId()
    {
        if ($this->lastInsertId)
        {
            $id = (int)$this->lastInsertId;
            return $id;
        }
    }

    public function t_begin() {
        return $this->db->beginTransaction();
    }

    public function t_commit() {
        return $this->db->commit();
    }

    public function t_rollback() {
        return $this->db->rollBack();
    }


    // Truncate table (Empty table details)
    /**
     * dbQuery::truncate()
     * 
     * @param mixed $table
     * @return
     */
    public function truncate($table)
    {
        $stmt = "TRUNCATE " . sprintf("%s", $table);
        $this->stmt = $stmt;
        return $this;
    }

    // View query.
    /**
     * dbQuery::viewQuery()
     * 
     * @return
     */
    public function viewQuery()
    {
        echo $this->stmt;
    }

    // Set data for prepared statements
    /**
     * dbQuery::setData()
     * 
     * @param mixed $cond
     * @param mixed $data
     * @return
     */
    private function setData($cond, $data)
    {
       
        foreach ($data as $key => $value)
        {

            if (preg_match("/(_____\d+)$/", $key)) {
                $key1 = preg_replace("/(_____\d+)$/", "", $key);
            } else {
                $key1 = sprintf("%s", $key);
            }

            $key2 = explode(".", $key);

            if (isset($key2[1])) {
                $key2 = $key2[1];
            } else {
                $key2 = $key2[0];
            }

            $var = sprintf("%s", $value);
            
            
            $this->bindData[$key2] = $var;
            $this->stmt .= $cond . $key1 . "=:" . $key2 . ","; 
                
        }
        
        $this->stmt = rtrim($this->stmt, ",");
        return $this;
    }

    //BIND
    /**
     * dbQuery::bind()
     * 
     * @param mixed $placeholder
     * @param mixed $value
     * @return
     */
    private function bind($placeholder, $value)
    {
        return $this->result->bindValue($placeholder, sprintf("%s", $value), PDO::PARAM_STR);
    }

    //Prefix all parameter array with comma
    /**
     * dbQuery::commaPrefix()
     * 
     * @param mixed $values
     * @return
     */
    private function commaPrefix($values){
                
        
        $params = implode(",", $values);
        return $params;
    }

    /**
     * dbQuery::commaStringPrefix()
     * 
     * @param mixed $values
     * @return
     */
    private function commaStringPrefix($values)
    {
        $values = implode("','", $values);
        $values = "'" . $values . "'";
        return $values;
    }
}

?>