<?php

$dsn = 'mysql:dbname=bokinMap; host=192.168.33.13; charset=utf8';
$usr = 'tomo';
$password = 'Tomo_0314';

  try {
    $db = new PDO($dsn, $usr, $password);
    $stt = $db->query("select latitude, longitude from places");
    $stt->execute();
    $i = 0;
    while ($row = $stt->fetch(PDO::FETCH_ASSOC)) {
      setcookie("lat[$i]", $row['latitude'], time() + (60 * 60 * 24));
      setcookie("lng[$i]", $row['longitude'], time() + (60 * 60 * 24));
      $i ++;
    }
//    for ($i = 0; $i < 72; $i++) {
//      print $_COOKIE['lat'][$i] . '<br/>';
//      print $_COOKIE['lng'][$i] . '<br/>';
//      print $i . '<br/>';
//    }
  } catch (PDOException $e) {
    print "error: {$e->getMessage()}";
  } finally {
    $db = null;
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>募金マップ</title>
  <link rel="stylesheet" href="css/test.css">
</head>
<body>
<main>
  <div id="map" class="map"></div>
  <script>
    var lat = [];
    var lng = [];
     var cookies = document.cookie; //全てのcookieを取り出して
     var cookiesArray = cookies.split(';'); // ;で分割し配列に
     // console.log(cookiesArray);
    for(var c of cookiesArray){ //一つ一つ取り出して
      var cArray = c.split('='); //さらに=で分割して配列に
      for (let i = 0; i < 72; i++) {
        if(cArray[0].trim() === `lat[${i}]`){ // 取り出したいkeyと合致したら
          lat[i] = cArray[1];  // [key,value]
        }
        if(cArray[0].trim() === `lng[${i}]`){ // 取り出したいkeyと合致したら(lngの前にある空白は、クッキーの値に勝手に空白が入っていたため書いた。)
          lng[i] = cArray[1];  // [key,value]
        }
      }
    }
    console.log(lat);
    console.log(lng);

    function initMap() {
      var place = {lat: 38.265237, lng: 140.866828};
      var map = new google.maps.Map(
          document.getElementById('map'),
          {
            center: place,
            zoom: 17
          }
      );
      var marker = [];
      for (var i = 0; i < 72; i++) {
        marker[i] = new google.maps.Marker({position: {lat: Number(lat[i]), lng: Number(lng[i])}, map: map});
      }
      console.log(marker);
    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrZIvzj3PJIbODIABFlNjEkIYyhHRfTyM&callback=initMap" async defer></script>
  <form action="mapData.php" method="post" class="form">
</main>
</body>
</html>