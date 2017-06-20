<?php
class Event {

  private $connection;

	function __construct($mysqli){
		$this->connection = $mysqli;
	}

//kooli lisamine
	function saveShool($id, $name, $type, $county, $parish, $city, $address, $postcode, $webpage) {

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
//koolide andmete lisamine
  function saveData($id, $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $notes) {

    $stmt = $this->connection->prepare("INSERT INTO s_data (id, year, REG_ID, students, boys, girls, teachers, language, notes) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    echo $this->connection->error;

    $stmt->bind_param("isiiiiiss", $id, $year, $REG_ID, $students, $boys, $girls, $teachers, $language, $notes);

    if ( $stmt->execute() ) {
    header("Location: aasta_muutmine.php?q=".$_GET['id']);
    exit();

    } else {
      echo "ERROR ".$stmt->error;
    }

  }
//direktori lisamine
  function saveDirector($REG_ID, $start_year, $end_year, $principal) {

    $stmt = $this->connection->prepare("INSERT INTO s_principals (REG_ID, start_year, end_year, principal) VALUE (?, ?, ?, ?)");
    echo $this->connection->error;

    $stmt->bind_param("iiis", $REG_ID, $start_year, $end_year, $principal);

    if ( $stmt->execute() ) {
    header("Location: direktori_muutmine.php?q=".$_GET['id']);
    exit();

    } else {
      echo "ERROR ".$stmt->error;
    }

  }
//võtab koolid
	function getSchools($q, $sort, $order, $e, $r, $y) {

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

      if ($name == "DEFAULT"){
        $name = "";
      }
			$human->name = $name;

      if ($type == "DEFAULT"){
        $type = "";
      }
			$human->type = $type;

      if ($county == "DEFAULT"){
        $county = "";
      }
			$human->county = $county;

      if ($parish == "DEFAULT"){
        $parish = "";
      }
      $human->parish = $parish;

      if ($city == "DEFAULT"){
        $city = "";
      }
      $human->city = $city;

      if ($address == "DEFAULT"){
        $address = "";
      }
			$human->address = $address;

      if ($postcode == "DEFAULT"){
        $postcode = "";
      }
      $human->postcode = $postcode;

      if ($webpage == "DEFAULT"){
        $webpage = "";
      }
			$human->webpage = $webpage;


			array_push($results, $human);

		}

		return $results;

	}
//võtab koolide andmeid
  function getData($q, $sort, $order, $w) {

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

      if ($year == "DEFAULT"){
        $yaer = "";
      }
      $human->year = $year;
      $human->REG_ID = $REG_ID;

      if ($students == "DEFAULT"){
        $students = "";
      }
      $human->students = $students;

      if ($boys == "DEFAULT"){
        $boys = "";
      }
      $human->boys = $boys;

      if ($girls == "DEFAULT"){
        $girls = "";
      }
      $human->girls = $girls;

      if ($teachers == "DEFAULT"){
        $teachers = "";
      }
      $human->teachers = $teachers;

      if ($language == "DEFAULT"){
        $language = "";
      }
      $human->language = $language;

      if ($notes == "DEFAULT"){
        $notes = "";
      }
      $human->notes = $notes;


      array_push($results, $human);

    }

    return $results;

  }
//võtab direktorid
  function getDirectors($q, $sort, $order) {

    $allowedSort = ["REG_ID", "start_year", "end_year", "principal"];

    if(!in_array($sort, $allowedSort)){
      $sort = "principal";
    }

    $orderBy = "ASC";

    if($order == "DESC") {
      $orderBy = "DESC";
    }

    if($q != "") {

      $stmt = $this->connection->prepare("
        SELECT REG_ID, start_year, end_year, principal
        FROM s_principals
        WHERE deleted IS NULL
        AND ( REG_ID LIKE ?)
        ORDER BY $sort $orderBy
      ");

      $searchId = "%".$q."%";

      $stmt->bind_param("s", $searchId);

    }

    else {

      $stmt = $this->connection->prepare("
        SELECT REG_ID, start_year, end_year, principal
        FROM s_principals
        WHERE deleted IS NULL
        ORDER BY $sort $orderBy
      ");
    }


    $stmt->bind_result($REG_ID, $start_year, $end_year, $principal);
    $stmt->execute();

    $results = array();

    while ($stmt->fetch()) {

      $human = new StdClass();
      $human->REG_ID = $REG_ID;

      if ($start_year == "DEFAULT"){
        $start_year = "";
      }
      $human->start_year = $start_year;

      if ($end_year == "DEFAULT"){
        $end_year = "";
      }
      $human->end_year = $end_year;

      if ($principal == "DEFAULT"){
        $principal = "";
      }
      $human->principal = $principal;


      array_push($results, $human);

    }

    return $results;

  }
//võtab koolid, mis on kustutatud
  function getDelSchools($q, $sort, $order, $e, $r, $y) {

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

      if ($name == "DEFAULT"){
        $name = "";
      }
			$human->name = $name;

      if ($type == "DEFAULT"){
        $type = "";
      }
			$human->type = $type;

      if ($county == "DEFAULT"){
        $county = "";
      }
			$human->county = $county;

      if ($parish == "DEFAULT"){
        $parish = "";
      }
      $human->parish = $parish;

      if ($city == "DEFAULT"){
        $city = "";
      }
      $human->city = $city;

      if ($address == "DEFAULT"){
        $address = "";
      }
			$human->address = $address;

      if ($postcode == "DEFAULT"){
        $postcode = "";
      }
      $human->postcode = $postcode;

      if ($webpage == "DEFAULT"){
        $webpage = "";
      }
			$human->webpage = $webpage;


			array_push($results, $human);

		}

		return $results;

	}
//võtab üks kool
	function getSingleSchool($edit_id){


		$stmt = $this->connection->prepare("SELECT name, type, county, parish, city, address, postcode, webpage FROM s_schools WHERE id=? AND deleted IS NULL");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($name, $type, $county, $parish, $city, $address, $postcode, $webpage);
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
//võtab andmeid ühest koolist
  function getSingleData($edit_id){


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

			header("Location: aasta_muutmine.php");
			exit();
		}

		$stmt->close();

		return $p;

	}
//võtab ühe direktori andmed
  function getSingleDirector($edit_principal){


    $stmt = $this->connection->prepare("SELECT REG_ID, start_year, end_year, principal FROM s_principals WHERE principal=? AND deleted IS NULL");

    $stmt->bind_param("s", $edit_principal);
    $stmt->bind_result($REG_ID, $start_year, $end_year, $principal);
    $stmt->execute();

    $p = new Stdclass();

    if($stmt->fetch()){

      $p->REG_ID = $REG_ID;
      $p->start_year = $start_year;
      $p->end_year = $end_year;
      $p->principal = $principal;

    }

    $stmt->close();

    return $p;

  }
//võtab üks kustutatud kool
  function getSingleSchoolDel($edit_id){


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
//teeb kooli update
	function updateSchools($id, $name, $type, $county, $city, $parish, $address, $postcode, $webpage){

		$stmt = $this->connection->prepare("UPDATE s_schools SET name=?, type=?, county=?, city=?, parish=?, address=?, postcode=?, webpage=?  WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("ssssssssi",$name, $type, $county, $city, $parish, $address, $postcode, $webpage, $id);


		if($stmt->execute()){

			echo "salvestus õnnestus!";
		}

		$stmt->close();

	}
//teeb kooli andmete update
  function updateData($id, $year, $students, $boys, $girls, $teachers, $language, $note){

    $stmt = $this->connection->prepare("UPDATE s_data SET year=?, students=?, boys=?, girls=?, teachers=?, language=?, notes=?  WHERE id=? AND deleted IS NULL");
    $stmt->bind_param("iiiiissi",$year, $students, $boys, $girls, $teachers, $language, $notes, $id);

    if($stmt->execute()){

      echo "salvestus õnnestus!";
    }

    $stmt->close();

  }
//teeb direktori update
  function updateDirectors($start_year, $end_year, $principal){

    $stmt = $this->connection->prepare("UPDATE s_principals SET start_year=?, end_year=?, principal=? WHERE principal=? AND deleted IS NULL");
    $stmt->bind_param("ssss",$start_year, $end_year, $principal, $principal);


    if($stmt->execute()){

      echo "salvestus õnnestus!";
    }

    $stmt->close();

  }
//kustutab koolid
	function deleteSchools($id){

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
//kustutab kooli andmed
  function deleteData($id){

    $database = "if16_kirikotk_4";

    $stmt = $this->connection->prepare("
    UPDATE s_data SET deleted=NOW()
    WHERE id=? AND deleted IS NULL");
    $stmt->bind_param("i",$id);

    if($stmt->execute()){

      echo "salvestus õnnestus!";
    }

    $stmt->close();

  }
//kustutab direktori
  function deleteDirectors($principal){

    $database = "if16_kirikotk_4";
    $stmt = $this->connection->prepare("
    UPDATE s_principals SET deleted=NOW()
    WHERE principal=?");
    $stmt->bind_param("s",$principal);

$redicet = $_SERVER['HTTP_REFERER'];
    if($stmt->execute()){
      header("Location: $redicet");
      exit();
    }

    $stmt->close();

  }
//taastab kustutatud koolid
  function addAgainSchools($id){

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
