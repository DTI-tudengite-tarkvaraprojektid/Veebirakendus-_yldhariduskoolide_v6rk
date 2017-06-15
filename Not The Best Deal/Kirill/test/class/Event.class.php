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
    header("Location: a_otsing_data.php");
    exit();

    } else {
      echo "ERROR ".$stmt->error;
    }

  }

	function getAllPeople($q, $sort, $order, $e, $r, $y) {

		$allowedSort = ["id", "name", "type", "county", "parish", "city", "address", "postcode", "webpage"];

		// sort ei kuulu lubatud tulpade sisse
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

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$e."%";
      $searchWord3 = "%".$y."%";
      $searchWord4 = "%".$r."%";

      $stmt->bind_param("ssss", $searchWord, $searchWord2, $searchWord3, $searchWord4);

    }

    elseif($q != "" && $e != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND county LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$e."%";
      $searchWord3 = "%".$y."%";

      $stmt->bind_param("sss", $searchWord, $searchWord2, $searchWord3);

    }
    elseif($q != "" && $e != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND county LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$e."%";
      $searchWord3 = "%".$r."%";

      $stmt->bind_param("sss", $searchWord, $searchWord2, $searchWord3);

    }
    elseif($q != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$y."%";
      $searchWord3 = "%".$r."%";

      $stmt->bind_param("sss", $searchWord, $searchWord2, $searchWord3);

    }
    elseif($e != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( county LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$e."%";
      $searchWord2 = "%".$y."%";
      $searchWord3 = "%".$r."%";

      $stmt->bind_param("sss", $searchWord, $searchWord2, $searchWord3);

    }

    elseif($q != "" && $e != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND county LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$e."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($q != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$y."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($q != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$r."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($e != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( county LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$e."%";
      $searchWord2 = "%".$y."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($e != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( county LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$e."%";
      $searchWord2 = "%".$r."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$y."%";
      $searchWord2 = "%".$r."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }

    elseif ($q != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( name LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";

      $stmt->bind_param("s", $searchWord);

    }
    elseif ($e != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( county LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$e."%";

      $stmt->bind_param("s", $searchWord);

    }
    elseif ($r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$r."%";

      $stmt->bind_param("s", $searchWord);

    }
    elseif ($y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NULL
        AND ( parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$y."%";

      $stmt->bind_param("s", $searchWord);

    }


    else {
			// ei otsi
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

		// tsükli sisu tehakse nii mitu korda, mitu rida
		// SQL lausega tuleb
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

    // sort ei kuulu lubatud tulpade sisse
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

      $searchWord = "%".$q."%";

      $stmt->bind_param("s", $searchWord);

    }

    elseif($w != "") {

      $stmt = $this->connection->prepare("
        SELECT id, year, REG_ID, students, boys, girls, teachers, language, notes
        FROM s_data
        WHERE deleted IS NULL
        AND ( REG_ID LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$w."%";

      $stmt->bind_param("s", $searchWord);

    }

    else {
      // ei otsi
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

    // tsükli sisu tehakse nii mitu korda, mitu rboysa
    // SQL lausega tuleb
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

		// sort ei kuulu lubatud tulpade sisse
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

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$e."%";
      $searchWord3 = "%".$y."%";
      $searchWord4 = "%".$r."%";

      $stmt->bind_param("ssss", $searchWord, $searchWord2, $searchWord3, $searchWord4);

    }

    elseif($q != "" && $e != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM NOT
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND county LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$e."%";
      $searchWord3 = "%".$y."%";

      $stmt->bind_param("sss", $searchWord, $searchWord2, $searchWord3);

    }
    elseif($q != "" && $e != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND county LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$e."%";
      $searchWord3 = "%".$r."%";

      $stmt->bind_param("sss", $searchWord, $searchWord2, $searchWord3);

    }
    elseif($q != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$y."%";
      $searchWord3 = "%".$r."%";

      $stmt->bind_param("sss", $searchWord, $searchWord2, $searchWord3);

    }
    elseif($e != "" && $y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( county LIKE ? AND parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$e."%";
      $searchWord2 = "%".$y."%";
      $searchWord3 = "%".$r."%";

      $stmt->bind_param("sss", $searchWord, $searchWord2, $searchWord3);

    }

    elseif($q != "" && $e != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND county LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$e."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($q != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$y."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($q != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";
      $searchWord2 = "%".$r."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($e != "" && $y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( county LIKE ? AND parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$e."%";
      $searchWord2 = "%".$y."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($e != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( county LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$e."%";
      $searchWord2 = "%".$r."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }
    elseif($y != "" && $r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( parish LIKE ? AND city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$y."%";
      $searchWord2 = "%".$r."%";

      $stmt->bind_param("ss", $searchWord, $searchWord2);

    }

    elseif ($q != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( name LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$q."%";

      $stmt->bind_param("s", $searchWord);

    }
    elseif ($e != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( county LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$e."%";

      $stmt->bind_param("s", $searchWord);

    }
    elseif ($r != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( city LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$r."%";

      $stmt->bind_param("s", $searchWord);

    }
    elseif ($y != "") {

      $stmt = $this->connection->prepare("
        SELECT id, name, type, county, parish, city, address, postcode, webpage
        FROM s_schools
        WHERE deleted IS NOT NULL
        AND ( parish LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchWord = "%".$y."%";

      $stmt->bind_param("s", $searchWord);

    }


    else {
			// ei otsi
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

		// tsükli sisu tehakse nii mitu korda, mitu rida
		// SQL lausega tuleb
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

		//tekitan objekti
		$p = new Stdclass();

		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$p->name = $name;
			$p->type = $type;
			$p->county = $county;
      $p->parish = $parish;
			$p->city = $city;
			$p->address = $address;
      $p->postcode = $postcode;
			$p->webpage = $webpage;


		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
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

		//tekitan objekti
		$p = new Stdclass();

		//saime ühe rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$p->year = $year;
			$p->students = $students;
			$p->boys = $boys;
      $p->girls = $girls;
			$p->teachers = $teachers;
			$p->language = $language;
      $p->notes = $notes;


		}else{
			// ei saanud rida andmeid kätte
			// sellist id'd ei ole olemas
			// see rida võib olla kustutatud
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

    //tekitan objekti
    $p = new Stdclass();

    //saime ühe rea andmeid
    if($stmt->fetch()){
      // saan siin alles kasutada bind_result muutujaid
      $p->name = $name;
      $p->type = $type;
      $p->county = $county;
      $p->parish = $parish;
      $p->city = $city;
      $p->address = $address;
      $p->postcode = $postcode;
      $p->webpage = $webpage;


    }else{
      // ei saanud rida andmeid kätte
      // sellist id'd ei ole olemas
      // see rida võib olla kustutatud
      header("Location: a_otsing_del.php");
      exit();
    }

    $stmt->close();

    return $p;

  }

	function updatePerson($id, $name, $type, $county, $city, $parish, $address, $postcode, $webpage){

		$stmt = $this->connection->prepare("UPDATE s_schools SET name=?, type=?, county=?, city=?, parish=?, address=?, postcode=?, webpage=?  WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssssssssi",$name, $type, $county, $city, $parish, $address, $postcode, $webpage, $id);

		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
			echo "salvestus õnnestus!";
		}

		$stmt->close();

	}

  function updatePersonData($id, $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $note){

    $stmt = $this->connection->prepare("UPDATE s_data SET id=?, year=?, REG_ID=?, students=?, boys=?, girls=?, teachers=?, language=?, notes=?  WHERE id=? AND deleted IS NULL");
    $stmt->bind_param("isissssss",$id, $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $notes);

    // kas õnnestus salvestada
    if($stmt->execute()){
      // õnnestus
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

		// kas õnnestus salvestada
		if($stmt->execute()){
			// õnnestus
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

    // kas õnnestus salvestada
    if($stmt->execute()){
      // õnnestus
      echo "salvestus õnnestus!";
    }

    $stmt->close();

  }


}
?>
