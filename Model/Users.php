  
<?php
class Users{
    private $id;
	private $cedula;
    private $nombre;
    private $apellido;
    private $edad;
    private $correo_electronico;
	function __construct($cedula, $nombre, $apellido, $edad, $correo){
        $this->cedula = $cedula;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->edad = $edad;
        $this->correo = $correo;
	}	
}	
$instancia = new MiClase("Pedro",25);
$instancia->saludar();
?>
Hola