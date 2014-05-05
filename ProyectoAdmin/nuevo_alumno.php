<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

// NO SE QUE ESTOY HACIENDO !!
 
sec_session_start();

login_check($mysqli) or die("No has iniciado sesion");




$nombre = $_SESSION['username'];
$correo = $_SESSION['correo'];
$sexo = $_SESSION['sexo'];

$conexion = new mysqli(
	'localhost', 'usuario', 'paydelimon', 'appGym');

if(mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$mysqli->query(
	"select  *, a.idAlumno as alumnoId, r.numRutina as rutinaId, " .
	"    e.idEjercicio as ejercicioId, e.nombre as ejercicioNombre " .
	"from alumno a " .
	"inner join rutina r on a.rutinaActual = r.numRutina " .
	"inner join rutina_ejercicio re on r.numRutina = re.numRutina " .
	"inner join ejercicio e on re.idEjercicio = e.idEjercicio " .
	"where a.idAlumno = " . $user_id
) or die($mysqli->error.__LINE__);

create table alumno(
	idAlumno int not null primary key,
	
	instructor int,
	rutinaActual int,
	nacimiento date,
	peso double,
	sexo enum('f', 'm') not null,
	foreign key (idAlumno) references member(id),
	foreign key (instructor) references instructor(idInstructor)
)engine = InnoDB;

 ?>


<?php
include_once 'includes/register.inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Register with us</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul>
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">
            Username: <input type='text' 
                name='username' 
                id='username' /><br>
            Email: <input type="text" name="email" id="email" /><br>
            Password: <input type="password"
                             name="password" 
                             id="password"/><br>
            Confirm password: <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" /><br>
            <input type="button" 
                   value="Register" 
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </body>
</html>
