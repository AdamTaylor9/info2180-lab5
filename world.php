<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);
$lookup = filter_input(INPUT_GET, "lookup", FILTER_SANITIZE_STRING);

$countryQuery = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

if ($lookup=="country"){
  $results = $countryQuery->fetchAll(PDO::FETCH_ASSOC);
}
else{
  $citiesQuery = $conn->query("SELECT cities.* FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%'");
  $results = $citiesQuery->fetchAll(PDO::FETCH_ASSOC);
}


?>

<?php

if (isset($country)){
  if ($lookup=="country"){
    echo("<table>");
      echo("<tr>");
        echo("<th>COUNTRY</th>");
        echo("<th>CONTINENT</th>");
        echo("<th>YEAR OF INDEPENDENCE</th>");
        echo("<th>HEAD OF STATE</th>");
      echo("</tr>");
    foreach ($results as $row){
      echo("<tr>");
        echo("<td>".$row["name"]."</td>");
        echo("<td>".$row["continent"]."</td>");
        echo("<td>".$row["independence_year"]."</td>");
        echo("<td>".$row["head_of_state"]."</td>");
      echo("</tr>");
    }
    echo("</table>");
  }
  else{
    echo("<table>");
      echo("<tr>");
        echo("<th>CITY NAME</th>");
        echo("<th>DISTRICT</th>");
        echo("<th>POPULATION</th>");
      echo("</tr>");
    foreach ($results as $row){
      echo("<tr>");
        echo("<td>".$row["name"]."</td>");
        echo("<td>".$row["district"]."</td>");
        echo("<td>".$row["population"]."</td>");
      echo("</tr>");
    }
  echo("</table>");
  }
}


?>
