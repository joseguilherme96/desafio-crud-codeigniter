<?php
 
 namespace App\Controllers;
 
use CodeIgniter\Controller;
 
class UploadDoc extends Controller    
{
    
    public function upload($file){
       
        $avatar = $file;
        $avatar->move(WRITEPATH . '../public');
        $data = [
        'name' =>  $avatar->getClientName(),
        'type'  => $avatar->getClientMimeType()
        ];
        $nomeArquivo = $avatar->getName();
       
        return $nomeArquivo;

    }

    
}