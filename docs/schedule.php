<?php
$DAY = array(1 => "2019-02-21", 2 => "2019-02-22", 3 => "2019-02-23");
$DAY_COLOR = array(1 => "danger", 2 => "warning", 3 => "info");
$VCE_BASE_URL = "https://www.vitchennaievents.com/register/?eventid=";

require('register/DB_Service/Events.php');

$eventsList = array();
foreach ($DAY as $day => $date) {
  $events = json_decode($eventsObj->getEventByDate($date), true);
  
  $fullTime = count($events);
  $thirdTime = ceil($fullTime / 3);

  for ($i = 0; $i < $thirdTime; $i++)
    $eventsList[$day][0][] = $events[$i];

  for ($i = $thirdTime; $i < $thirdTime * 2; $i++)
    $eventsList[$day][1][] = $events[$i];
  
  for ($i = $thirdTime * 2; $i < $fullTime; $i++)
    $eventsList[$day][2][] = $events[$i];
}

// print_r($eventsList);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/team/favicon.ico">
  <title>Schedule - Vibrance 19</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
  <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

  <style>
    .is-fjalla {
      font-family: 'Fjalla One', sans-serif;
    }

    .is-size-big {
      font-size: 4em;
    }

    .is-size-bigger {
      font-size: 8em;
    }

    #vibrance-logo {
      height: 10em;
    }

  </style>
</head>
<body>
<section class="section">
  <div class="container">
    <div class="has-text-right">
      <a class="button is-white is-large" href="."><i class="fas fa-home"></i></a>
    </div>
    <center>
      <a href=".">
        <img id="vibrance-logo" src="register/img/vit_text_dark.png">
      </a>
      <h1 class="is-fjalla is-size-big">SCHEDULE</h1>
    </center>
  </div>
</section>

<?php foreach ($DAY as $day => $date) { ?>
<section class="hero is-medium is-<?=$DAY_COLOR[$day]?>">
  <div class="hero-body">
    <div class="container">
      <div class="columns is-gapless">
        <div class="column is-4">
          <h1 class="title is-fjalla is-size-bigger has-text-centered">
            DAY <?=$day?>
          </h1>
          <h2 class="subtitle has-text-centered is-date is-fjalla">
            <?=$date?>
          </h2>
        </div>
        <div class="column is-1">&emsp;</div>
        <?php for ($i = 0; $i < 3; $i++) { ?>
        <div class="column">
          <?php foreach ($eventsList[$day][$i] as $event) { ?>
            <a class="button is-<?=$DAY_COLOR[$day]?> is-uppercase is-fjalla" target="_blank" href="<?=$VCE_BASE_URL?><?=$event['idevent']?>"><?=$event['eventname']?></a><br />
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
<?php } ?>

<script src="register\js\jquery-3.3.1.min.js"></script>
<script src="register\js\moment.min.js"></script>
<script>
  $('.is-date').each(function(e) {
    var date = new Date($(this).html());
    $(this).html(moment(date, "YYYY-MM-DD").format('dddd, MMMM Do YYYY'));
  });
</script>