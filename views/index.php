<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Asistencia MTG</title>
    <!--<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />-->
    <link rel="shortcut icon" href="<?php echo RUTA . 'assets/'; ?>images/mtg2.png" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="<?php echo RUTA . 'assets/'; ?>css/snackbar.min.css">
    <link href="<?php echo RUTA . 'assets/index/'; ?>css/styles.css" rel="stylesheet" />
</head>

<body>
    <img class="bg-video" src="<?php echo RUTA . 'assets/images/login.webp'; ?>" alt="">
    <!-- Masthead-->
    <div class="masthead">
        <div class="masthead-content text-white">
            <div class="container-fluid px-lg-0">
                <div class="widget">
                    <div class="fecha">
                        <p id="diaSemana" class="diaSemana"></p>
                        <p id="dia" class="dia"></p>
                        <p>de </p>
                        <p id="mes" class="mes"></p>
                        <p>del </p>
                        <p id="year" class="year"></p>
                    </div>
                    <div class="reloj">
                        <p id="horas" class="horas"></p>
                        <p>:</p>
                        <p id="minutos" class="minutos"></p>
                        <p>:</p>
                        <div class="caja-segundos">
                            <p id="segundos" class="segundos"></p>
                            <p id="ampm" class="ampm"></p>
                        </div>
                    </div>
                    <div class="reloj">
                        <a href=""><img src="<?php echo RUTA . 'assets/'; ?>images/mtg2.png" width="100" alt="logo" /></a>
                    </div>
                </div>
                <h1 class="fst-italic lh-1 mb-4">Sistema de registro de asistencia 2</h1>
                <p class="mb-5">Entradas y salidas de las personas</p>
                <form id="contactForm" autocomplete="off">
                    <div class="row input-group-newsletter">
                        <div class="col"><input class="form-control" id="codigo" name="codigo" type="text" placeholder="Ingrese DNI" /></div>
                        <div class="col-auto"><button class="btn btn-primary" id="submitButton" type="submit">Registrar</button></div>
                    </div>
                    <div>
                        <img id="FPImage1" alt="Fingerpint Image" height=300 width=210 align="center" src=".\Images\PlaceFinger.bmp"> <br>
                        <input type="button" value="Click to Scan" onclick="captureFP()"><br>
                        <br>
                        <p id="result">Env</p>
                    </div>

                    <div class="social-icons">
                        <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                            <div>
                                <label>
                                    <input type="radio" name="radio" value="entrada" checked />
                                    <span>Entrada</span>
                                </label>
                                <label>
                                    <input type="radio" name="radio" value="salida" />
                                    <span>Salida</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="social-icons">
        <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
            <a class="btn btn-primary" href="plantilla.php?pagina=login">Login</a>
        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo RUTA . 'assets/'; ?>js/snackbar.min.js"></script>
    <script src="<?php echo RUTA . 'assets/'; ?>js/axios.min.js"></script>
    <script>
        const ruta = '<?php echo RUTA; ?>';

        function message(tipo, mensaje) {
            Snackbar.show({
                text: mensaje,
                pos: 'top-right',
                backgroundColor: tipo == 'success' ? '#079F00' : '#FF0303',
                actionText: 'Cerrar'
            });
        }
    </script>
    <script>

        function captureFP() {
            CallSGIFPGetData(SuccessFunc, ErrorFunc);
        }

        function SuccessFunc(result) {
            if (result.ErrorCode == 0) {
                /* 	Display BMP data in image tag
                    BMP data is in base 64 format 
                */
                if (result != null && result.BMPBase64.length > 0) {
                    document.getElementById("FPImage1").src = "data:image/bmp;base64," + result.BMPBase64;
                }
                var tbl = "<table border=1>";
                tbl += "<tr>";
                tbl += "<td> Serial Number of device </td>";
                tbl += "<td> <b>" + result.SerialNumber + "</b> </td>";
                tbl += "</tr>";
                tbl += "<tr>";
                tbl += "<td> Image Height</td>";
                tbl += "<td> <b>" + result.ImageHeight + "</b> </td>";
                tbl += "</tr>";
                tbl += "<tr>";
                tbl += "<td> Image Width</td>";
                tbl += "<td> <b>" + result.ImageWidth + "</b> </td>";
                tbl += "</tr>";
                tbl += "<tr>";
                tbl += "<td> Image Resolution</td>";
                tbl += "<td> <b>" + result.ImageDPI + "</b> </td>";
                tbl += "</tr>";
                tbl += "<tr>";
                tbl += "<td> Image Quality (1-100)</td>";
                tbl += "<td> <b>" + result.ImageQuality + "</b> </td>";
                tbl += "</tr>";
                tbl += "<tr>";
                tbl += "<td> NFIQ (1-5)</td>";
                tbl += "<td> <b>" + result.NFIQ + "</b> </td>";
                tbl += "</tr>";
                tbl += "<tr>";
                tbl += "<td> Template(base64)</td>";
                tbl += "<td> <b> <textarea rows=8 cols=50>" + result.TemplateBase64 + "</textarea></b> </td>";
                tbl += "</tr>";
                tbl += "<tr>";
                tbl += "<td> Image WSQ Size</td>";
                tbl += "<td> <b>" + result.WSQImageSize + "</b> </td>";
                tbl += "</tr>";
                tbl += "<tr>";
                tbl += "<td> EncodeWSQ(base64)</td>";
                tbl += "<td> <b> <textarea rows=8 cols=50>" + result.WSQImage + "</textarea></b> </td>";
                tbl += "</tr>";
                tbl += "</table>";
                document.getElementById('result').innerHTML = tbl;
            } else {
                alert("Fingerprint Capture Error Code:  " + result.ErrorCode + ".\nDescription:  " + ErrorCodeToString(result.ErrorCode) + ".");
            }
        }

        function ErrorFunc(status) {

            /* 	
                If you reach here, user is probabaly not running the 
                service. Redirect the user to a page where he can download the
                executable and install it. 
            */
            alert("Check if SGIBIOSRV is running; Status = " + status + ":");

        }

        function CallSGIFPGetData(successCall, failCall) {
            // 8.16.2017 - At this time, only SSL client will be supported.
            var uri = "https://localhost:8443/SGIFPCapture";

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    fpobject = JSON.parse(xmlhttp.responseText);
                    console.log(fpobject);
                    successCall(fpobject);
                } else if (xmlhttp.status == 404) {
                    failCall(xmlhttp.status)
                }
            }
            var params = "Timeout=" + "10000";
            params += "&Quality=" + "50";
            params += "&licstr=" + encodeURIComponent(secugen_lic);
            params += "&templateFormat=" + "ISO";
            params += "&imageWSQRate=" + "0.75";
            console.log
            xmlhttp.open("POST", uri, true);
            xmlhttp.send(params);

            xmlhttp.onerror = function() {
                failCall(xmlhttp.statusText);
            }
        }

        function ErrorCodeToString(ErrorCode) {
            var Description;
            switch (ErrorCode) {
                // 0 - 999 - Comes from SgFplib.h
                // 1,000 - 9,999 - SGIBioSrv errors 
                // 10,000 - 99,999 license errors
                case 51:
                    Description = "System file load failure";
                    break;
                case 52:
                    Description = "Sensor chip initialization failed";
                    break;
                case 53:
                    Description = "Device not found";
                    break;
                case 54:
                    Description = "Fingerprint image capture timeout";
                    break;
                case 55:
                    Description = "No device available";
                    break;
                case 56:
                    Description = "Driver load failed";
                    break;
                case 57:
                    Description = "Wrong Image";
                    break;
                case 58:
                    Description = "Lack of bandwidth";
                    break;
                case 59:
                    Description = "Device Busy";
                    break;
                case 60:
                    Description = "Cannot get serial number of the device";
                    break;
                case 61:
                    Description = "Unsupported device";
                    break;
                case 63:
                    Description = "SgiBioSrv didn't start; Try image capture again";
                    break;
                default:
                    Description = "Unknown error code or Update code to reflect latest result";
                    break;
            }
            return Description;
        }
    </script>
    <script src="<?php echo RUTA . 'assets/index/'; ?>js/scripts.js"></script>

</body>
<script>
    var secugen_lic = "hE/78I5oOUJnm5fa5zDDRrEJb5tdqU71AVe+/Jc2RK0=";
</script>

</html>