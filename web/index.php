<?php

$file = file_get_contents('data.json');
$file = json_decode($file);

?>

<!DOCTYPE html>
<!--
Copyright Chris Heppell & Chester-le-Street ASC 2017. Bootstrap CSS and
JavaScript is Copyright Twitter Inc, 2011-2017, jQuery v3.1.0 is Copyright
jQuery Foundation 2016
Designed by Chris Heppell, www.heppellit.com
Yes! We built this in house. Not many clubs do. We don't cheat.
-->
<html lang="en-GB" prefix="og:http://ogp.me/ns#">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="apple-mobile-web-app-title" content="CLS ASC">
  <meta name="format-detection" content="telephone=no">
  <!--<script>var shiftWindow = function() { scrollBy(0, -100) }; if (location.hash) shiftWindow(); window.addEventListener("hashchange", shiftWindow);</script>-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700|Roboto+Mono|Merriweather:400,600" type="text/css">
  <link rel="stylesheet" href="./assets/css/main.css" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">

  <!-- Generic icon -->
  <link rel="icon" href="https://membership.myswimmingclub.uk/img/corporate/scds.png">

  <!-- For iPhone 6 Plus with @3× display: -->
  <link rel="apple-touch-icon-precomposed" sizes="180x180" href="https://membership.myswimmingclub.uk/img/corporate/icons/apple-touch-icon-180x180.png">
  <!-- For iPad with @2× display running iOS ≥ 7: -->
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="https://membership.myswimmingclub.uk/img/corporate/icons/apple-touch-icon-152x152.png">
  <!-- For iPad with @2× display running iOS ≤ 6: -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="https://membership.myswimmingclub.uk/img/corporate/icons/apple-touch-icon-144x144.png">
  <!-- For iPhone with @2× display running iOS ≥ 7: -->
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="https://membership.myswimmingclub.uk/img/corporate/icons/apple-touch-icon-120x120.png">
  <!-- For iPhone with @2× display running iOS ≤ 6: -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="https://membership.myswimmingclub.uk/img/corporate/icons/apple-touch-icon-114x114.png">
  <!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7: -->
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="https://membership.myswimmingclub.uk/img/corporate/icons/apple-touch-icon-76x76.png">
  <!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6: -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="https://membership.myswimmingclub.uk/img/corporate/icons/apple-touch-icon-72x72.png">
  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
  <link rel="apple-touch-icon-precomposed" href="https://membership.myswimmingclub.uk/img/corporate/icons/apple-touch-icon.png"><!-- 57×57px -->

  <title>Gala Programme</title>

  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
    .focus-highlight a:focus,
    .blog-sidebar a:focus,
    .event a:focus,
    .hentry a:focus,
    .blog-main a:focus {
      background: #ffbf47;
      outline: 3px solid #ffbf47;
      outline-offset: 0;
    }

    footer .focus-highlight a:focus {
      color: #212529;
    }

    body {
      padding-bottom: 3.25rem;
    }

    .two-columns {
      list-style: none;
      padding-left: 0;
    }

    .two-columns li,
    .event-column-header {
      padding: 0.2rem 0.35rem;
    }

    /* .two-columns {
      list-style-position: inside;
      padding-left: 0;
      display: block;
    }

    .two-columns ::marker {
      width: 20px;
      float: left;
    }

    .two-columns .row {
      width: calc(100% - 20px);
      float: right;
    }

    .two-columns li {
      padding: 0.25rem;
      display: block;
      height: fit-content;
    } */

    .two-columns li:nth-child(2n) {
      background: #eee;
    }

    .time-cell {
      width: 5rem;
      max-width: 120px;
    }

    .top-0 {
      top: 0;
      z-index: 990;
    }

    @media screen and (min-width: 992px) {
      .two-columns {
        /* grid-template-columns: repeat(2, 1fr); */
      }

      .two-columns li:nth-child(n+1) {
        /* border-top:none; */
      }

      /* .two-columns li:nth-child(4n-1), .two-columns li:nth-child(4n) {
          background: #eee;
        } */
    }
  </style>

</head>

<body class="home page-template-default page page-id-12">

  <div class="sr-only sr-only-focusable">
    <a href="#maincontent">Skip to main content</a>
  </div>

  <nav class="navbar fixed-bottom navbar-dark bg-primary">
    <div class="container-fluid">
      <form class="mx-auto form-inline">
        <div class="form-group mb-0">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Jump to event</span>
            </div>
            <select class="custom-select" id="event-select">
              <!-- <option disabled selected>Jump to an event</option> -->
              <?php foreach ($file->sessions as $session) { ?>


                <?php if (sizeof($file->sessions) > 1) { ?>
                  <optgroup label="<?= htmlspecialchars('Session ' . $session->id) ?>">
                  <?php } ?>

                  <?php foreach ($session->events as $event) { ?>
                    <?php if (strpos($event->event, 'FINAL') === false) { ?>
                      <option value="<?= htmlspecialchars('event-' . ($event->id)) ?>">
                        <?= htmlspecialchars('Event ' . $event->id . ' ' . $event->name) ?>
                      </option>
                    <?php } ?>
                  <?php } ?>

                  <?php if (sizeof($file->sessions) > 1) { ?>
                  </optgroup>
                <?php } ?>

              <?php } ?>
            </select>
          </div>
        </div>
      </form>
    </div>
  </nav>

  <div class="d-print-none mb-3">

    <div class="text-dark py-3 d-lg-flex bg-light">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col col-sm-10 col-lg-8">
            <div class="row align-items-center">
              <div class="col-auto">
                <img class="rounded" src="./assets/img/scds.png" alt="SCDS Logo" style="height: 75px">
              </div>
              <div class="col">
                <div class="h1">Online Gala Programme</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div id="maincontent"></div>

  <!--
      PROGRAMME OUTPUT
    -->

  <div class="container-fluid">

    <div class="row justify-content-center">
      <div class="col col-sm-10 col-lg-8">

        <p class="lead">
          This is a new kind of gala programme being trialled by <a href="https://myswimmingclub.uk" target="_blank">Swimming Club Data Systems</a> and <a href="https://www.chesterlestreetasc.co.uk/" target="_blank">Chester-le-Street ASC</a>.
        </p>

        <p>
          We would appreciate if you could <a href="mailto:feedback@myswimmingclub.uk">give us feedback</a>, or <a target="_blank" href="https://github.com/Swimming-Club-Data-Systems/PRN-Parser">check out this project on GitHub</a>.
        </p>

        <?php if (sizeof($file->sessions) > 1) { ?>
          <div class="bg-primary p-3 mb-3 rounded text-white">
            <h2>Sessions</h2>
            <p class="lead">
              Jump to a session.
            </p>

            <ul class="list-unstyled mb-0">
              <?php foreach ($file->sessions as $session) { ?>
                <li><a href="#<?= htmlspecialchars('session-' . ($session->id)) ?>" class="text-white">Session <?= htmlspecialchars($session->id) ?></a></li>
              <?php } ?>
            </ul>
          </div>
        <?php } ?>

        <?php foreach ($file->sessions as $session) { ?>

          <?php if (sizeof($file->sessions) > 1) { ?>
            <h2 id="<?= htmlspecialchars('session-' . ($session->id)) ?>">Session <?= htmlspecialchars($session->id) ?></h2>
          <?php } ?>

          <?php foreach ($session->events as $event) { ?>
            <h3 id="<?= htmlspecialchars('event-' . ($event->id)) ?>">
              <small class="text-muted font-weight-bold">Event <?= htmlspecialchars($event->id) ?></small><br>
              <?= htmlspecialchars($event->name) ?>
            </h3>

            <div>
              <div class="position-sticky top-0 bg-primary text-white">
                <div class="form-row event-column-header font-weight-bold">
                  <div class="col-5 col-xl-4 text-truncate">
                    Name
                  </div>
                  <?php if (true) { ?>
                    <div class="col-1 col-xl-3">
                      Age
                    </div>
                  <?php } ?>
                  <div class="col text-truncate">
                    Club
                  </div>
                  <?php if (true) { ?>
                    <div class="col time-cell text-truncate text-right">
                      Entry time
                    </div>
                  <?php } ?>
                </div>
              </div>

              <ol class="two-columns">
                <?php foreach ($event->swims as $swimmer) { ?>
                  <?php if ($swimmer->name != "") { ?>
                    <li>
                      <div class="form-row">
                        <div class="col-5 col-xl-4 text-truncate">
                          <?= htmlspecialchars($swimmer->name) ?>
                        </div>
                        <?php if ($swimmer->age !== null) { ?>
                          <div class="col-1 col-xl-3 text-truncate">
                            <?= htmlspecialchars($swimmer->age) ?>
                          </div>
                        <?php } ?>
                        <div class="col text-truncate">
                          <?= htmlspecialchars($swimmer->club) ?>
                        </div>
                        <?php if ($swimmer->sub_time != null) { ?>
                          <div class="col time-cell text-truncate text-right">
                            <?= htmlspecialchars($swimmer->sub_time) ?>
                          </div>
                        <?php } ?>
                      </div>
                    </li>
                  <?php } else { ?><li></li><?php } ?>
                <?php } ?>
              </ol>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>

  <footer>

    <div class="cls-global-footer-legal">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-auto">
            <a href="https://myswimmingclub.uk" target="_blank" title="Swimming Club Data Systems Website">
              <img src="https://membership.myswimmingclub.uk/img/corporate/scds.png" class="rounded" width="100">
            </a>
            <div class="d-block d-sm-none mb-3"></div>
          </div>
          <div class="col">

            <p class="mb-2">
              This software is open source. <a class="text-white font-weight-bold" target="_blank" href="https://github.com/Swimming-Club-Data-Systems/PRN-Parser/blob/main/LICENSE">Available under the BSD 2-Clause "Simplified" License</a>.
            </p>

            <p class="mb-2">
              <a class="text-white font-weight-bold" target="_blank" href="https://github.com/Swimming-Club-Data-Systems/PRN-Parser">View on GitHub</a>.
            </p>

            <p class="mb-2">
              Display sizes - <span class="d-xs-inline">XS</span><span class="d-none d-sm-inline">, SM</span><span class="d-none d-md-inline">, MD</span><span class="d-none d-lg-inline">, LG</span><span class="d-none d-xl-inline">, XL</span>
            </p>

            <p class="mb-0 source-org vcard copyright">
              &copy; 2020 <span class="org fn">Swimming Club Data Systems</span>. Swimming Club Data Systems is not responsible
              for the content of external sites.
            </p>
          </div>
        </div>
      </div>
    </div><!-- /.container -->

    <script src="./assets/js/main.js"></script>

    <script>
      let eventSelect = document.getElementById('event-select');
      eventSelect.addEventListener('change', event => {
        console.log(event.target.value);
        let top = document.getElementById(event.target.value).scrollIntoView();
        // window.scrollTo(0, top);
      });
    </script>

  </footer>
</body>

</html>