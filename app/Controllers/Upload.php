<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class Upload extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        return view('templates/header',['title'=>'Upload'])
            .   view('formularios/upload_form', ['errors' => []])
            .   view('templates/footer');
        
    }
    
    public function upload()
    {
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => 'uploaded[userfile]'
                    . '|is_image[userfile]'
                    . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[userfile,3000]'
                    . '|max_dims[userfile,3000,3000]',
            ],
        ];
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('formularios/upload_form', $data);
        }

        $img = $this->request->getFile('userfile');



        if (! $img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $img->store();
            
            $data = ['uploaded_flleinfo' => new File($filepath)];

            
            return view('templates/header',['title'=>'Upload'])
            .   view('formularios/upload_sucess',$data)
            .   view('templates/footer');
        }
        $data = ['errors' => 'The file has already been moved.'];

        return view('formularios/upload_form', $data);
    }

   

}