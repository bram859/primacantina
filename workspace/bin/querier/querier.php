<?php

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    
// Settings
global $DATABASES;
$DATABASES = [
    ['name' => 'Postcode', 'host' => $servername, 'user' => $username, 'pwd' => '', 'db' => 'postcode'],
    ['name' => 'Project', 'host' => $servername, 'user' => $username, 'pwd' => '', 'db' => 'project'],
    ['name' => 'Top-2000 v1', 'host' => $servername, 'user' => $username, 'pwd' => '', 'db' => 'top_2000_v1'],
    ['name' => 'Top-2000 v2', 'host' => $servername, 'user' => $username, 'pwd' => '', 'db' => 'top_2000_v2'],
    ['name' => 'Weerstations', 'host' => $servername, 'user' => $username, 'pwd' => '', 'db' => 'weerstations'],

];

const MAX_ROWS = 1000;

/* There are NO checks in this script for DML queries like INSERT and
 * UPDATE or DDL queries like CREATE TABLE, ALTER, DROP, etc.
 *
 * If these types of queries shouldn't be possible, make sure the
 * database user used in DATABASE_USER only has the proper grants
 * in the database
 *
 * Additionally, this script does NOT check for multiple queries in
 * the input SQL.
 */

/**
 * Main script
 */

try {

    if (getParameter('query')) {
        fetchDatabaseId();
        $result = query(getParameter('query'));
    } elseif (getParameter('dbs')) {
        $result = ['dbs' => databases()];
    } elseif (getParameter('default_query')) {
        $result = ['dbs' => databases()];
    } elseif (getParameter('db_def')) {
        fetchDatabaseId();
        $result = ['db_def' => loadDatabaseDefinition()];
    } else {
        // If no query or request for database definition: render the HTML page
        renderPage();
        return;
    }

} catch (Exception $e) {
    $result = ['error' => $e->getMessage()];
}

// Return the result of query / db as JSON
header('Content-Type: application/json');
$json = json_encode($result, JSON_PRETTY_PRINT, 10);

if($json === false) {
    $json = json_encode(['error' => json_last_error_msg()]);
}

echo $json;

die();
/**
 * End of main script
 */


// -----------------------------------------------------------------------
// functions
// -----------------------------------------------------------------------

/**
 * Helper function
 *
 * @param $sql
 * @return array
 */
function query($sql)
{
    $result = queryAndFetch(modifyQuery($sql));
    return $result;
}

function databases()
{
    global $DATABASES;
    $result = [];
    foreach ($DATABASES as $id => $db) {
        $result[$id] = ['id' => $id, 'name' => $db['name']];
    }

    return $result;
}

/**
 * Loads the definition from the database
 *
 * @return array
 */
function loadDatabaseDefinition()
{
    global $databaseDef;

    $sql = "show tables;";
    $tables = queryAndFetch($sql, MYSQLI_BOTH);

    $databaseDef = [];
    foreach ($tables['data'] as $table) {
        $tableName = $table['_0'];
        $databaseDef[$tableName] = descTable($tableName);
    }

    return $databaseDef;
}

/**
 * Describe the table
 *
 * @param $table
 * @return array
 */
function descTable($table)
{
    $sql = "desc " . $table;
    return queryAndFetch($sql);
}


/**
 * Query the database and return the result as an array.
 *
 * @param string $sql raw SQL
 * @param int $rowType
 * @return array
 */
function queryAndFetch($sql, $rowType = MYSQLI_ASSOC)
{
    $resultSet = executeQuery($sql);
    if ($resultSet === false) {
        if (connection()->errno) {
            return buildError();
        } else {
            return ['error' => 'Onbekende fout opgetreden'];
        }
    } else {
        $result = [];
        $row = $resultSet->fetch_array($rowType);
        $count = 0;
        while ($row != null && $count < MAX_ROWS) {
            $tmp = fixKeys($row);
            $result[] = $tmp;

            $row = $resultSet->fetch_array($rowType);
            $count++;
        }
        return ['data' => $result, 'has_more' => ($resultSet->fetch_assoc() != null), 'count' => $count];
    }
}

/**
 * Checks if the SQL is a valid SELECT query
 *
 * @param $sql
 * @return bool
 */
function isValidSelect($sql)
{
    $sql = trim(trim($sql), ";");
    $mysqli = connection();
    return $mysqli->prepare($sql) !== false && strpos($sql, 'select ') === 0;
}

/**
 * Adds a limit to the query if it is a valid SELECT query and if a limit isn't present yet
 *
 * @param $sql
 * @return string
 */
function modifyQuery($sql)
{
    if (isValidSelect($sql) && strpos($sql, "limit ") === false) {
        $sql = trim(trim($sql), ";");
        $sql .= " limit " . MAX_ROWS;
        return $sql;
    } else {
        return $sql;
    }

}

/**
 * Runs the given query against the database
 *
 * @param $sql
 * @return bool|mysqli_result
 */
function executeQuery($sql)
{
    $mysqli = connection();
    return $mysqli->query($sql);
}

/**
 * Builds an error array for the last query run
 *
 * @return array
 */
function buildError()
{
    return [
        'error' => [
            'type' => 'query',
            'number' => connection()->errno,
            'error' => connection()->error
        ]
    ];
}

/**
 * Creates an MySQL connection and returns it, or if a connection has already been made the existing connection
 *
 * @return mysqli
 */
function connection()
{
    global $mysqli;
    global $DATABASEID;
    global $DATABASES;

    $databaseConnectionData = @$DATABASES[$DATABASEID];
    if (!$databaseConnectionData) {
        throw new \Exception("Geen database gevonden voor gegeven ID");
    }

    if (!$mysqli) {
        $mysqli = new mysqli($databaseConnectionData ['host'], $databaseConnectionData['user'], $databaseConnectionData['pwd'], $databaseConnectionData['db']);
        mysqli_set_charset($mysqli, "utf8");
    }
    return $mysqli;
}

/**
 * Helper function to get the parameter from the GET or POST parameters array
 *
 * @param $paramName
 * @return null
 */
function getParameter($paramName)
{
    if (isset($_GET[$paramName])) {
        return $_GET[$paramName];
    }
    if (isset($_POST[$paramName])) {
        return $_POST[$paramName];
    }
    return null;
}


function fetchDatabaseId()
{
    global $DATABASEID;
    global $DATABASES;
    $DATABASEID = getParameter('db');
    if ($DATABASEID === null || !is_numeric($DATABASEID) || $DATABASEID < 0 || $DATABASEID >= count($DATABASES)) {
        throw new Exception('Geen juiste database ID meegegeven');
    }
}

/**
 * Load the HTML page (from seperate file)
 */
function renderPage()
{
    echo file_get_contents('page.html');
}

function fixKeys($array) {
    $result = [];
    foreach($array as $k => $v) {
        $k = strtolower($k);
        if(is_numeric($k)) {
            $k = "_" . $k;
        }
        $result[$k] = $v;
    }
    return $result;
}
