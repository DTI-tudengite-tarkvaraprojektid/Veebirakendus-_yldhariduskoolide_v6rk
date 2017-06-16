<?php
class Event {

  private $connection;

	function __construct($mysqli){
		$this->connection = $mysqli;
	}


	function saveEvent($id, $name, $type, $county, $parish, $city, $address, $postcode, $webpage) {

		$stmt = $this->connection->prepare("INSERT INTO s_schools (id, name, type, county, parish, city, address, postcode, webpage) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		echo $this->connection->error;

		$stmt->bind_param("sssssssss", $id, $name, $type, $county, $parish, $city, $address, $postcode, $webpage);

		if ( $stmt->execute() ) {
		header("Location: a_otsing.php");
		exit();

		} else {
			echo "ERROR ".$stmt->error;
		}

	}

  function saveEventData($id, $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $notes) {

    $stmt = $this->connection->prepare("INSERT INTO s_data (id, year, REG_ID, students, boys, girls, teachers, language, notes) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    echo $this->connection->error;

    $stmt->bind_param("sssssssss", $id, $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $notes);

    if ( $stmt->execute() ) {
    header("Location: a_otsing.php");
    exit();

    } else {
      echo "ERROR ".$stmt->error;
    }

  }

	function getAllPeople($q, $sort, $order, $e, $r, $y) {

		$allowedSort = ["id", "name", "type", "county", "parish", "city", "address", "postcode", "webpage"];

		if(!in_array($sort, $allowedSort)){
			$sort = "id";
		}

		$orderBy = "ASC";

		if($order == "DESC") {
			$orderBy = "DESC";
		}

    if($q != "" && $e != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND county LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCounty = "%".$e."%";
      $searchParish = "%".$y."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("ssss", $searchName, $searchCounty, $searchParish, $searchCity);

    }

    elseif($q != "" && $e != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND county LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCounty = "%".$e."%";
      $searchParish = "%".$y."%";

      $stmt->bind_param("sss", $searchName, $searchCounty, $searchParish);

    }
    elseif($q != "" && $e != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND county LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCounty = "%".$e."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("sss", $searchName, $searchCounty, $searchCity);

    }
    elseif($q != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchParish = "%".$y."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("sss", $searchName, $searchParish, $searchCity);

    }
    elseif($e != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( county LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCounty = "%".$e."%";
      $searchParish = "%".$y."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("sss", $searchCounty, $searchParish, $searchCity);

    }

    elseif($q != "" && $e != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND county LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCounty = "%".$e."%";

      $stmt->bind_param("ss", $searchName, $searchCounty);

    }
    elseif($q != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchParish = "%".$y."%";

      $stmt->bind_param("ss", $searchName, $searchParish);

    }
    elseif($q != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("ss", $searchName, $searchCity);

    }
    elseif($e != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( county LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCounty = "%".$e."%";
      $searchParish = "%".$y."%";

      $stmt->bind_param("ss", $searchCounty, $searchParish);

    }
    elseif($e != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( county LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCounty = "%".$e."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("ss", $searchCounty, $searchCity);

    }
    elseif($y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchParish = "%".$y."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("ss", $searchParish, $searchCity);

    }

    elseif ($q != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";

      $stmt->bind_param("s", $searchName);

    }
    elseif ($e != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( county LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCounty = "%".$e."%";

      $stmt->bind_param("s", $searchCounty);

    }
    elseif ($r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCity = "%".$r."%";

      $stmt->bind_param("s", $searchCity);

    }
    elseif ($y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchParish = "%".$y."%";

      $stmt->bind_param("s", $searchParish);

    }


    else {
			$stmt = $this->connection->prepare("
				SELECT id, name, type, county, parish, city, address, postcode, webpage
				FROM s_schools
				WHERE deleted IS NULL
				ORDER BY $sort $orderBy
			");
		}


		$stmt->bind_result($id, $name, $type, $county, $parish, $city, $address, $postcode, $webpage);
		$stmt->execute();

		$results = array();

		while ($stmt->fetch()) {

			$human = new StdClass();
			$human->id = $id;
			$human->name = $name;
			$human->type = $type;
			$human->county = $county;
      $human->parish = $parish;
			$human->city = $city;
			$human->address = $address;
      $human->postcode = $postcode;
			$human->webpage = $webpage;


			array_push($results, $human);

		}

		return $results;

	}

  function getAllPeopleData($q, $sort, $order, $w) {

    $allowedSort = ["id", "year", "REG_ID", "students", "boys", "girls", "teachers", "language", "notes"];

    if(!in_array($sort, $allowedSort)){
      $sort = "boys";
    }

    $orderBy = "ASC";

    if($order == "DESC") {
      $orderBy = "DESC";
    }

    if($q != "") {

      $stmt = $this->connection->prepare("
        SELECT id, year, REG_ID, students, boys, girls, teachers, language, notes
        FROM s_data
        WHERE deleted IS NULL
        AND ( id LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchId = "%".$q."%";

      $stmt->bind_param("s", $searchId);

    }

    elseif($w != "") {

      $stmt = $this->connection->prepare("
        SELECT id, year, REG_ID, students, boys, girls, teachers, language, notes
        FROM s_data
        WHERE deleted IS NULL
        AND ( REG_ID LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchReg_id = "%".$w."%";

      $stmt->bind_param("s", $searchReg_id);

    }

    else {

      $stmt = $this->connection->prepare("
        SELECT id, year, REG_ID, students, boys, girls, teachers, language, notes
        FROM s_data
        WHERE deleted IS NULL
        ORDER BY $sort $orderBy
      ");
    }


    $stmt->bind_result($id, $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $notes);
    $stmt->execute();

    $results = array();

    while ($stmt->fetch()) {

      $human = new StdClass();
      $human->id = $id;
      $human->year = $year;
      $human->REG_ID = $REG_ID;
      $human->students = $students;
      $human->boys = $boys;
      $human->girls = $girls;
      $human->teachers = $teachers;
      $human->language = $language;
      $human->notes = $notes;


      array_push($results, $human);

    }

    return $results;

  }

  function getDelPeople($q, $sort, $order, $e, $r, $y) {

		$allowedSort = ["id", "name", "type", "county", "parish", "city", "address", "postcode", "webpage"];

		if(!in_array($sort, $allowedSort)){
			$sort = "id";
		}

		$orderBy = "ASC";

		if($order == "DESC") {
			$orderBy = "DESC";
		}

    if($q != "" && $e != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND county LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCounty = "%".$e."%";
      $searchParish = "%".$y."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("ssss", $searchName, $searchCounty, $searchParish, $searchCity);

    }

    elseif($q != "" && $e != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM NOT
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND county LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCounty = "%".$e."%";
      $searchParish = "%".$y."%";

      $stmt->bind_param("sss", $searchName, $searchCounty, $searchParish);

    }
    elseif($q != "" && $e != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND county LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCounty = "%".$e."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("sss", $searchName, $searchCounty, $searchCity);

    }
    elseif($q != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchParish = "%".$y."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("sss", $searchName, $searchParish, $searchCity);

    }
    elseif($e != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( county LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCounty = "%".$e."%";
      $searchParish = "%".$y."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("sss", $searchCounty, $searchParish, $searchCity);

    }

    elseif($q != "" && $e != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND county LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCounty = "%".$e."%";

      $stmt->bind_param("ss", $searchName, $searchCounty);

    }
    elseif($q != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchParish = "%".$y."%";

      $stmt->bind_param("ss", $searchName, $searchParish);

    }
    elseif($q != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("ss", $searchName, $searchCity);

    }
    elseif($e != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( county LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCounty = "%".$e."%";
      $searchParish = "%".$y."%";

      $stmt->bind_param("ss", $searchCounty, $searchParish);

    }
    elseif($e != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( county LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCounty = "%".$e."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("ss", $searchCounty, $searchCity);

    }
    elseif($y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchParish = "%".$y."%";
      $searchCity = "%".$r."%";

      $stmt->bind_param("ss", $searchParish, $searchCity);

    }

    elseif ($q != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchName = "%".$q."%";

      $stmt->bind_param("s", $searchName);

    }
    elseif ($e != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( county LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCounty = "%".$e."%";

      $stmt->bind_param("s", $searchCounty);

    }
    elseif ($r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchCity = "%".$r."%";

      $stmt->bind_param("s", $searchCity);

    }
    elseif ($y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchParish = "%".$y."%";

      $stmt->bind_param("s", $searchParish);

    }


    else {

			$stmt = $this->connection->prepare("
				SELECT id, name, type, county, parish, city, address, postcode, webpage
				FROM s_schools
				WHERE deleted IS NOT NULL
				ORDER BY $sort $orderBy
			");
		}


		$stmt->bind_result($id, $name, $type, $county, $parish, $city, $address, $postcode, $webpage);
		$stmt->execute();

		$results = array();

		while ($stmt->fetch()) {

			$human = new StdClass();
			$human->id = $id;
			$human->name = $name;
			$human->type = $type;
			$human->county = $county;
      $human->parish = $parish;
			$human->city = $city;
			$human->address = $address;
      $human->postcode = $postcode;
			$human->webpage = $webpage;


			array_push($results, $human);

		}

		return $results;

	}

	function getSinglePerosonData($edit_id){


		$stmt = $this->connection->prepare("SELECT name, type, county, parish, city, address, postcode, webpage FROM s_schools WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($name, $type, $county, $city, $parish, $address, $postcode, $webpage);
		$stmt->execute();

		$p = new Stdclass();

		if($stmt->fetch()){

			$p->name = $name;
			$p->type = $type;
			$p->county = $county;
      $p->parish = $parish;
			$p->city = $city;
			$p->address = $address;
      $p->postcode = $postcode;
			$p->webpage = $webpage;


		}else{

			header("Location: a_otsing.php");
			exit();
		}

		$stmt->close();

		return $p;

	}

  function getSinglePerosonDataData($edit_id){


		$stmt = $this->connection->prepare("SELECT year, students, boys, girls, teachers, language, notes FROM s_data WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($year, $students, $boys, $girls, $teachers, $language, $notes);
		$stmt->execute();

		$p = new Stdclass();

		if($stmt->fetch()){

			$p->year = $year;
			$p->students = $students;
			$p->boys = $boys;
      $p->girls = $girls;
			$p->teachers = $teachers;
			$p->language = $language;
      $p->notes = $notes;


		}else{

			header("Location: a_otsing_data.php");
			exit();
		}

		$stmt->close();

		return $p;

	}

  function getSinglePerosonDataDel($edit_id){


    $stmt = $this->connection->prepare("SELECT name, type, county, parish, city, address, postcode, webpage FROM s_schools WHERE id=? AND deleted IS NOT NULL");

    $stmt->bind_param("i", $edit_id);
    $stmt->bind_result($name, $type, $county, $city, $parish, $address, $postcode, $webpage);
    $stmt->execute();

    $p = new Stdclass();

    if($stmt->fetch()){

      $p->name = $name;
      $p->type = $type;
      $p->county = $county;
      $p->parish = $parish;
      $p->city = $city;
      $p->address = $address;
      $p->postcode = $postcode;
      $p->webpage = $webpage;


    }else{

      header("Location: a_otsing_del.php");
      exit();
    }

    $stmt->close();

    return $p;

  }

	function updatePerson($id, $name, $type, $county, $city, $parish, $address, $postcode, $webpage){

		$stmt = $this->connection->prepare("UPDATE s_schools SET name=?, type=?, county=?, city=?, parish=?, address=?, postcode=?, webpage=?  WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssssssssi",$name, $type, $county, $city, $parish, $address, $postcode, $webpage, $id);


		if($stmt->execute()){

			echo "salvestus õnnestus!";
		}

		$stmt->close();

	}

  function updatePersonData($id, $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $note){

    $stmt = $this->connection->prepare("UPDATE s_data SET id=?, year=?, REG_ID=?, students=?, boys=?, girls=?, teachers=?, language=?, notes=?  WHERE id=? AND deleted IS NULL");
    $stmt->bind_param("isissssss",$id, $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $notes);


    if($stmt->execute()){

      echo "salvestus õnnestus!";
    }

    $stmt->close();

  }

	function deletePerson($id){

        $database = "if16_kirikotk_4";

		$stmt = $this->connection->prepare("
		UPDATE s_schools SET deleted=NOW()
		WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i",$id);

		if($stmt->execute()){

			echo "salvestus õnnestus!";
		}

		$stmt->close();

	}

  function addAgainPerson($id){

    $database = "if16_kirikotk_4";

    $stmt = $this->connection->prepare("
    UPDATE s_schools SET deleted=NULL
    WHERE id=? AND deleted IS NOT NULL");
    $stmt->bind_param("i",$id);


    if($stmt->execute()){

      echo "salvestus õnnestus!";
    }

    $stmt->close();

  }


}
?>
