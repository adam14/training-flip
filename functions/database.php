<?php

/**
 *  dbconnect method
 *  database connection using pdo
 */
function dbconnect()
{		
	global $config;
	
	$con = new PDO("mysql:host=".$config['database']['host'].";dbname=".$config['database']['dbname'].";charset=utf8", $config['database']['username'], $config['database']['password']);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $con;
}

/**
 *  dbget method
 *  get all data from table
 *  @param string $table, array $clause, array $condition
 *  @return array $result
 */
function dbget($table, $clause = [], $condition = [])
{
    $cond = '';
    $query = "SELECT * FROM ".$table;

    if (array_key_exists('sort', $clause) && array_key_exists('order', $clause)) {
        $query = "SELECT * FROM ".$table." ORDER BY ".$clause['sort']." ".$clause['order'];
    }

    if (!empty($condition)) {
        $i = 1;

        foreach ($condition as $c) {
            if ($i == 1) {
                $cond .= $c;
            } else {
                $cond .= " AND ".$c;
            }

            $i++;
        }

        $query = "SELECT * FROM ".$table." WHERE ".$cond;

        if (array_key_exists('sort', $clause) && array_key_exists('order', $clause)) {
            $query = "SELECT * FROM ".$table." WHERE ".$cond." ORDER BY ".$clause['sort']." ".$clause['order'];
        }
    }

    if (array_key_exists('limit', $clause)) {
        if (is_numeric($clause['limit'])) {
            $query .= " LIMIT ".$clause['limit'];
        }
    }

    $data = dbconnect()->prepare($query);
    $data->execute();

    $data_temp = [];

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        $data_temp[] = $row;
    }

    $result = $data_temp;

    return $result;
}


/**
 *  dbdetail method
 *  get detail data from table
 *  @param string $table, array $condition
 *  @return object $result
 */
function dbdetail($table, $condition = [])
{
    $cond = '';
    $query = "SELECT * FROM ".$table;

    if (!empty($condition)) {
        $i = 1;

        foreach ($condition as $c) {
            if ($i == 1) {
                $cond .= $c;
            } else {
                $cond .= " AND ".$c;
            }

            $i++;
        }

        $query = "SELECT * FROM ".$table." WHERE ".$cond;   
    }

    $data = dbconnect()->prepare($query);
    $data->execute();

    $result = $data->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/**
 *  dbinsert method
 *  insert data to table
 *  @param string $table, array $data
 *  @return bool $inserted
 */
function dbinsert($table, $data)
{
    $data_temp = '';
    $inserted = 0;

    if (!empty($data)) {
        $i = 1;

        foreach ($data as $key => $value) {
            if ($i == 1) {
                $data_temp .= $key." = ".dbconnect()->quote($value);
            } else {
                $data_temp .= ", ".$key." = ".dbconnect()->quote($value);
            }

            $i++;
        }
    }

    if (!empty($data_temp)) {
        $query = dbconnect()->prepare("INSERT INTO ".$table." SET ".$data_temp);
        $query->execute();
        $inserted = $query->rowCount();
    }

    return $inserted;
}

/**
 *  dbupdate method
 *  update data to table
 *  @param string $table, array $condition, array $data
 *  @return bool $updated
 */
function dbupdate($table, $condition, $data)
{
	$cond = '';
	$data_temp = '';
	$updated = 0;
	
	if (!empty($condition)) {
		$i = 1;
		
		foreach ($condition as $key => $value) {
			if ($i == 1) {
				$cond .= $key." = ".dbconnect()->quote($value); 
			} else {
				$cond .= " AND ".$key." = ".dbconnect()->quote($value);
			}
			
			$i++;
		}
	}
	
	if (!empty($data)) {
		$i = 1;
		
		foreach ($data as $key => $value) {
			if ($i == 1) {
				if ($value == '') {
					$data_temp .= $key." = 'NULL'";
				} else {
					$data_temp .= $key." = ".dbconnect()->quote($value); 
				}
			} else {
				if ($value == '') {
					$data_temp .= ", ".$key." = 'NULL'";
				} else {
					$data_temp .= ", ".$key." = ".dbconnect()->quote($value);
				}
			}
			
			$i++;
		}
	}

	if (!empty($data_temp) && !empty($cond)) {
		$query = dbconnect()->prepare("UPDATE ".$table." SET ".$data_temp." WHERE ".$cond);
		
		if ($query->execute()) {
			$updated = 1;
		}
		
		//$updated = $query->execute();
	}

	return $updated;
}

/**
 *  insertflip method
 *  insert data to API flip
 *  @param array $data
 *  @return $data_flip
 */
function insertflip($data)
{
    $ch = curl_init();

    $header = array(
        'Content-Type: application/x-www-form-urlencoded',
    );
    $url = 'https://nextar.flip.id/disburse';
    $key = 'HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41';

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_USERPWD, $key.":");

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

/**
 *  getdataflip method
 *  get data flip to API flip
 *  @param int $disburse_id
 *  @return $data_flip
 */
function getdataflip($disburse_id)
{
    $ch = curl_init();

    $header = array(
        'Content-Type: application/x-www-form-urlendcoded',
    );
    $url = 'https://nextar.flip.id/disburse/'.$disburse_id;
    $key = 'HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41';

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_USERPWD, $key.":");

    $reponse = curl_exec($ch);
    curl_close($ch);

    return $reponse;
}