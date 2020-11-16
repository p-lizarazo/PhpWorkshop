  
<?php
class User{
    public $id;
	public $cedula;
    public $nombre;
    public $apellido;
    public $edad;
    public $correo_electronico;
	function __construct($cedula, $nombre, $apellido, $edad, $correo){
        $this->cedula = $cedula;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->edad = $edad;
        $this->correo = $correo;
    }
    
    
}
?>