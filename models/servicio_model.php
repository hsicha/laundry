<?php
class Servicio_Model extends Model{
    private $sms;
function __construct()
{
    parent::__construct();
}
public function ListarServicio(){
    $stm=$this->db->prepare("SELECT (@i:=@i+1) AS N°, S.IDSERVICIO, S.DESCRIPCION FROM SERVICIO S CROSS JOIN(SELECT @i:=0)S; ");
    $stm->execute();
    $data=$stm->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($data,JSON_UNESCAPED_UNICODE);
}
public function ExportarExcel(){
    return $this->db->select("SELECT IDSERVICIO, DESCRIPCION FROM SERVICIO");
}
 function InsertarServicio($data){
    if ($this->existeServicio($data)==0) {
        $stm = $this->db->insert('SERVICIO', $data);
        if ($stm == true) {
            $this->sms = "Registrado correctamente";
        }else{
            $this->sms = "No se pudo registrar, vuelva a intentarlo";
        }
    }else{
        $this->sms = "La categoría <strong>". $data['DESCRIPCION'] . "</strong> ya existe";
    }
    return $this->sms;



}
 function Update($data){
    if($this->existeServicio($data)==0){
        $stm=$this->db->update("SERVICIO".$data, "IDSERVICIO={$data['IDSERVICIO']}");
        if($stm==true){
            $this->sms="Servicio Actualizado";
        }else{
            $this->sms="Error al Actualizar Servicio";
        }
    }else{
        $this->sms="El Servicio ".$data.["DESCRIPCION"]."Ya existe";
    }
    return $this->sms;

}
 function Delete(){

}
 function existeServicio($data){
    $sql=$this->db->prepare("SELECT * FROM SERVICIO WHERE IDSERVICIO <> :IDSERVICIO AND DESCRIPCION = :DESCRIPCION");
    $sql->bindParam(':IDSERVICIO' , $data['IDSERVICIO'] , PDO::PARAM_STR);
    $sql->bindParam(':DESCRIPCION' , $data['DESCRIPCION'] , PDO::PARAM_STR);
    $sql->execute();
    $count = $sql->rowCount();
    return $count;

}


}

?>