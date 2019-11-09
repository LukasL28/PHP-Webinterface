<?php
session_start();
if(!isset($_SESSION["4huzhg234lklsdfgu"])){
  header("Location: ../index.php");
  exit;
} else {
		$expireAfter = 60 * 2;
		if(isset($_SESSION['last_action'])){
			$secondsInactive = time() - $_SESSION['last_action'];
			$expireAfterSeconds = $expireAfter * 60;

			if($secondsInactive >= $expireAfterSeconds){
			   	 session_unset();
       			 session_destroy();
				header("Location: ../index.php");
				exit;
   			 }
		}
	$_SESSION['last_action'] = time();
	}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <title>KingKürbis.net | TEAM</title>
  </head>
  <body>
    <div class="conetnt" style="width:100%; height:100%; background:-moz-element(#particles-js);">
    <div id="particles-js"></div>
      <h2>Frohe Weihnachten: <?php echo $_SESSION["4huzhg234lklsdfgu"]; ?>!</h2>
      <h3>Du hast die Wahl zwischen mehreren Geschenken!</h3>
    <?php
    require("../rankmanager.php");
    //echo "Dein Rang: ".getRank($_SESSION["4huzhg234lklsdfgu"]);
     ?>
    <div class="buttons">
     <?php
     if(getRank($_SESSION["4huzhg234lklsdfgu"]) >= USER) {
      ?>
      <button onclick="window.open('../account.php', '_top');" class="add" type="button" name="button">Account</button>
      <button onclick="window.open('../logout.php', '_top');" class="add" type="button" name="button">Logout</button>
    <?php
    if(getRank($_SESSION["4huzhg234lklsdfgu"]) >= ADMIN) {
     ?>
      <button onclick="window.open('../register.php', '_top');" class="add" type="button" name="button">Account Erstellen</button>
      <button onclick="window.open('../admin.php', '_top');" class="add" type="button" name="button">Admin Pannel</button>
     <?php
   }
     ?>
    </div>
     <?php
     if(getRank($_SESSION["4huzhg234lklsdfgu"]) == DEV) {
     ?>
    <div class="version">
      <h3>Version: 1.01</h3>
      <h2>Dein Rang: <?php getRank($_SESSION["4huzhg234lklsdfgu"]);
      if (getRank($_SESSION["4huzhg234lklsdfgu"]) == 21) {
        echo "Developer";
      } else {
        echo "Fehler!";
      }
      ?>
    </h2>
    </div>
    <?php
  }
     ?>
    <div class="auswahl">
  <a target="_blank" href="/login/team/tickets">
    <img src="Geschenk.png" alt="Test1" width="600" height="400">
  </a>
  <div class="desc">Ticketsystem</div>
</div>

<div class="auswahl">
  <a target="_blank" href="/login/team/bans">
    <img src="Geschenk.png" alt="Test2" width="600" height="400">
  </a>
  <div class="desc">Bannsystem</div>
</div>

<div target="_top" class="auswahl">
  <a href="#">
    <img src="Geschenk.png" alt="Test3" width="600" height="400">
  </a>
  <div class="desc">Forum</div>
  </div>
  <?php
  if(getRank($_SESSION["4huzhg234lklsdfgu"]) >= ADMIN) {
  ?>
  <div target="_top" class="auswahl">
  <a href="/login/team/test">
      <img src="Geschenk.png" alt="Test4" width="600" height="400">
    </a>
   <div class="desc">Test</div>
  </div>
  <?php
  }

  if(getRank($_SESSION["4huzhg234lklsdfgu"]) >= ADMIN) {
  ?>
  <div target="_top" class="auswahl">
    <a href="/phpmyadmin">
      <img src="Geschenk.png" alt="phpmyadmin" width="600" height="400">
    </a>
   <div class="desc">phpMyAdmin</div>
  </div>
  <?php
  }
}
 ?>
 </div>
  </body>
</html>
<script src="particles.js"></script>
<script src="app.js"></script>
<script>
/* -----------------------------------------------
/* How to use? : Check the GitHub README
/* ----------------------------------------------- */

/* To load a config file (particles.json) you need to host this demo (MAMP/WAMP/local)... */


/* Otherwise just put the config content (json): */

particlesJS('particles-js',

{
"particles": {
  "number": {
    "value": 400,
    "density": {
      "enable": true,
      "value_area": 800
    }
  },
  "color": {
    "value": "#fff"
  },
  "shape": {
    "type": "circle",
    "stroke": {
      "width": 0,
      "color": "#000000"
    },
    "polygon": {
      "nb_sides": 5
    },
    "image": {
      "src": "img/github.svg",
      "width": 100,
      "height": 100
    }
  },
  "opacity": {
    "value": 0.6,
    "random": true,
    "anim": {
      "enable": false,
      "speed": 1,
      "opacity_min": 0.1,
      "sync": false
    }
  },
  "size": {
    "value": 8,
    "random": true,
    "anim": {
      "enable": false,
      "speed": 40,
      "size_min": 0.1,
      "sync": false
    }
  },
  "line_linked": {
    "enable": false,
    "distance": 500,
    "color": "#ffffff",
    "opacity": 0.4,
    "width": 2
  },
  "move": {
    "enable": true,
    "speed": 6,
    "direction": "bottom",
    "random": false,
    "straight": false,
    "out_mode": "out",
    "bounce": false,
    "attract": {
      "enable": false,
      "rotateX": 600,
      "rotateY": 1200
    }
  }
},
"interactivity": {
  "detect_on": "canvas",
  "events": {
    "onhover": {
      "enable": false,
      "mode": "bubble"
    },
    "onclick": {
      "enable": false,
      "mode": "repulse"
    },
    "resize": true
  },
  "modes": {
    "grab": {
      "distance": 400,
      "line_linked": {
        "opacity": 0.5
      }
    },
    "bubble": {
      "distance": 400,
      "size": 4,
      "duration": 0.3,
      "opacity": 1,
      "speed": 3
    },
    "repulse": {
      "distance": 200,
      "duration": 0.4
    },
    "push": {
      "particles_nb": 4
    },
    "remove": {
      "particles_nb": 2
    }
  }
},
"retina_detect": true
}

);

</script>
<style media="screen">
  body{ margin:0;} canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ position:absolute; width: 100%; height: 100%; background-image: url("");
  background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align:
  left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px;
  margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }</style>
<!---
Code and Style by Gipfel (Der WebDev vom Team)
~Verunstaltet von Luki (Der Systemzerstörer vom Team)
--->
