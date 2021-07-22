<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=10">
    <meta name="author" content="treZeta">
    <meta name="robots" content="noindex">
    <link rel="stylesheet" href="styles/main.css">
    <script src="https://kit.fontawesome.com/7a32a48a5f.js" crossorigin="anonymous"></script>
    <link rel="icon" href="img/logo_tirpitz_transparente.ico">
    <script type="text/javascript">
    var _app = navigator.appName;
    var rtvregval = -1;
    var gtftyp;

    if (_app == "Netscape") {
        alert("Esta aplicaci�n corre solamente en Microsoft Internet Explorer !!!");
    } else if (_app == "Microsoft Internet Explorer") {
        //Continue
    }

    function endVeri() {
        var chkvstat = document.getElementById("authstat").value;
        if (chkvstat == 1) {} else if (chkvstat == 0) {
            alert(
                "Utilice la huella dactilar CORRECTA para el prop�sito de la verificaci�n o para entrar con su identidad VERDADERA si �ste no es USTED!"
            );
            window.location = "#";
        }
        return chkvstat;
    }

    function getIDVal(aval) {
        var arrayval = aval;
        alert("value from vbscript is " + arrayval);
        var arraystring;
        arraystring = document.getElementById("dbhexstr" + arrayval).value;
        return arraystring;
    }

    function getFPType(swara) {
        var ftyp = swara;
        gtftyp = ftyp;
    }

    function getREGID(ridval) {
        var regftyp = gtftyp;
        var regval = ridval;
        var vidstart = document.getElementById("authstat").value;
        var id = document.getElementById("dbfpempid-" + regval).value;
        var idmbresame = document.getElementById("dbfpempfname-" + regval).value;
        var empapellidosame = document.getElementById("dbfpempsname-" + regval).value;

        if (regftyp == 1) {
            var fpno = fp1no;
            alert("Huella 1");
        }
        if (regftyp == 2) {
            var fpno = fp2no;
            alert("Huella 2");
        }
        if (vidstart == 1) {
            alert("VERIFICADO CON �XITO 1 !");
            window.location = "validateDate.php?jmu1=" + id;
        }

    }

    function getContraBio(xbioval) {
        var xval = xbioval;
        var payloadval = document.getElementById("cntstaff").value;
        //alert("xval is " + xval + " payload is " + payloadval);
        if (xval == payloadval) {
            alert("Personal no v�lido / no autorizado. Acceso denegado !!!");
            alert(
                "Use el dedo correcto para la identificaci�n o p�ngase en contacto con el administrador para registrarse!"
            );
        } else {
            //Do Nothing: Relevant part of code already executed. Application should not find itself here!!!
            //alert("Do Nothing: Relevant part of code already executed. Application should not find itself here !!!");
            //AUDIT for this incidence
        }
    }
    </script>
</head>

<?php

include_once 'includes/userSession.php';
$userSession = new userSession();

if (!isset($_SESSION['user'])) {
	header('Location: login.php');
}

$service = "Refrigerio";

if (isset($_POST['service'])) {
	if ($_POST['service'] == "") {
		$service = "Refrigerio";
	} else {
		$service = "Almuerzo";
	}
}

?>

<body class="<?php echo $service ?>">


    <?php

	include_once 'views/navBar.php';
	include 'includes/db.php';

	$db = new db();

	$load_veri = '<object id="DPFPVerControl" classid="clsid:F4AD5526-3497-4B8C-873A-A108EA777493"></object>';

	?>

    <div class="container">
        <h1 class="<?php echo $service ?>">Sistema PAE</h1>

        <div class="serviceContainer">

            <p class="Refrigerio">Refrigerio</p>

            <form id="serviceForm" action="" method="POST">
                <label class="switch">
                    <input name="service" value="Almuerzo" type="checkbox"
                        onclick="document.getElementById('serviceForm').submit()" <?php if ($service == "Almuerzo") {
																																			echo "checked";
																																		} ?>>
                    <span class="slider round"></span>
                </label>
            </form>

            <p class="Almuerzo">Almuerzo</p>

        </div>

        <div class="fingerprint-reader-container">
            <?php
			echo $load_veri;
			?>
        </div>

        <p class="<?php echo $service; ?>">Esperando un ingreso...</p>
    </div>

    <?php

	$staff_count = 0;

	$query = $db->connect()->prepare("SELECT id, nombres, apellidos, huella1, huella2 FROM estudiantes WHERE programaAlimentario = :programaAlimentario");

	$query->execute(array(':programaAlimentario' => $service));

	foreach ($query as $row) {
		$fpdata1[] = $row['huella1'];
		$fpdata2[] = $row['huella2'];
		$fpid[] = $row['id'];
		$fpempfname[] = $row['nombres'];
		$fpempsname[] = $row['apellidos'];
		$staff_count++;
	}

	if ($staff_count >= 1) {

		for ($i = 0; $i < sizeof($fpid); $i++) {
			$k = $i + 1;
		}

		$fpdata1_count = 1;
		foreach ($fpdata1 as $fpdata1_val) {
	?>
    <input type="hidden" name="dbhexstr1[]" id="<?php echo "dbhexstr1-$fpdata1_count"; ?>"
        value="<?php echo $fpdata1_val; ?>">
    <?php
			$fpdata1_count++;
		}
		$fpdata2_count = 1;
		foreach ($fpdata2 as $fpdata2_val) {
		?>
    <input type="hidden" name="dbhexstr1[]" id="<?php echo "dbhexstr2-$fpdata2_count"; ?>"
        value="<?php echo $fpdata2_val; ?>">
    <?php
			$fpdata2_count++;
		}
		$fpempid_count = 1;
		foreach ($fpid as $fpempid_val) {
		?>
    <input type="hidden" name="dbfpempid[]" id="<?php echo "dbfpempid-$fpempid_count"; ?>"
        value="<?php echo $fpempid_val; ?>">
    <?php
			$fpempid_count++;
		}

		$fpempfname_count = 1;
		foreach ($fpempfname as $fpempid_val) {
		?>
    <input type="hidden" name="dbfpempfname[]" id="<?php echo "dbfpempfname-$fpempfname_count"; ?>"
        value="<?php echo $fpempid_val; ?>">
    <?php
			$fpempfname_count++;
		}

		$fpempsname_count = 1;
		foreach ($fpempsname as $fpempid_val) {
		?>
    <input type="hidden" name="dbfpempsname[]" id="<?php echo "dbfpempsname-$fpempsname_count"; ?>"
        value="<?php echo $fpempid_val; ?>">
    <?php
			$fpempsname_count++;
		}

		echo '<input type="hidden" name="cntstaff" id="cntstaff" class="cntstaff" value="' . sizeof($fpid) . '">';
		echo '<input type="hidden" name="authstat" id="authstat" class="authstat" value="-1" onchange="endVeri()">';
	}

	?>
</body>
<script type='text/vbscript' src="indentifyUser.vbs"></script>

</html>