<?php
class MConexion {

    //atributos
    private $host = "localhost";
    private $usuario = "root";
    private $db = "db_biblioteca";
    private $clave = "";
    private $con = 0;

    //
    public function conectar() {
        $this->con = mysql_connect($this->host, $this->usuario, $this->clave)
                or die("No se encuentra el servidor");
        mysql_select_db($this->db, $this->con)
                or die("No se encuentra la base de datos");
    }

    public function desconectar() {
        mysql_close($this->con);
    }

    public function consulta($sql) {
        $this->conectar();
        $result = mysql_query($sql);
        return $result;
    }

    public function cuantos_registros($sql) {
        $this->conectar();
        $num = mysql_num_rows($sql);
        return $num;
    }

    public function sacarRegistro($sql) {
        $this->conectar();
        $result = mysql_query($sql);
        $reg = mysql_fetch_array($result);
        return $reg;
    }

    public function sacarLongitud($sql) {
        $this->conectar();
        $reg = mysql_fetch_lengths($sql);
        return $reg;
    }

}
