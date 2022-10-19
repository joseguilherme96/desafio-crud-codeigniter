<?php 

namespace App\Models;

use CodeIgniter\Model;

class newsModelCadastro extends Model
{
    protected $table='pessoa';  
    protected $allowedFields = ['id','nome', 'cpf','cep','imagem','documento'];

    public function getDados($id=false)
    {
        if($id==false){
            return $this->findAll();
        }

        return $this->where(['id'=>$id])->find();
    }
}