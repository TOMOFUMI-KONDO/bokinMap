<?php
  require_once dirname(__FILE__) . '/config.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>募金マップ</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>募金マップ</h1>
  </header>
  <main>
    <div id="map" class="map"></div>
    <script>
       var cookies = document.cookie; //全てのcookieを取り出して
       var cookiesArray = cookies.split(';'); // ;で分割し配列に
       for(var c of cookiesArray){ //一つ一つ取り出して
         var cArray = c.split('='); //さらに=で分割して配列に
         if(cArray[0].trim() === 'lat'){ // 取り出したいkeyと合致したら
           var $lat = cArray[1];  // [key,value]
           console.log($lat);
         }
         if(cArray[0].trim() === 'lng'){ // 取り出したいkeyと合致したら(lngの前にある空白は、クッキーの値に勝手に空白が入っていたため書いた。)
           var $lng = cArray[1];  // [key,value]
           console.log($lng);
         }
       }
       if (!$lat) {
         $lat = 'noExist';
       }
       if (!$lng) {
         $lng = 'noExist';
       }

       function initMap() {
         var place = {lat: $lat === 'noExist' ? 38.261235 : Number($lat), lng: $lng === 'noExist' ? 140.871144 :Number($lng)};
         var map = new google.maps.Map(
             document.getElementById('map'),
             {
               center: place,
               zoom: 17
             }
         );
        if ($lat !== 'noExist' && $lng !== 'noExist') {
          var marker = new google.maps.Marker({position: place, map: map});

          var infoWindow = new google.maps.InfoWindow({ // 吹き出しの追加
            content: "<?php echo $_COOKIE['message'] ?? ''; ?>" // 吹き出しに表示する内容
          });
          marker.addListener('click', function() { // マーカーをクリックしたとき
            infoWindow.open(map, marker); // 吹き出しの表示
          });
        }
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo getenv('API_KEY') ?>&callback=initMap" async defer></script>
    <form action="./process/map_data.php" method="post" class="form">
      <label for="id">ID:<input type="text" name="id" class="input" autocomplete="off"></label>
      <input type="submit" value="店舗を検索" class="submit">
    </form>
    <p class="error"><?php echo $_COOKIE['message'] ?? ''; ?></p>
    <div id="place_list" class="place_list">
      <?php include_once './process/place_list.php'; ?>
    </div>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="effect.js"></script>
</body>
</html>