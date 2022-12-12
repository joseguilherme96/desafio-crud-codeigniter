<?php

namespace App\Controllers;

use App\Models\NewsModelCadastro;

use CodeIgniter\Files\File;

use App\Controllers\UploadDoc;

class Pages extends BaseController
{
    public function index()
    {
        $data['title']='Formulario';
        return view ('templates/header',$data);
    }
    
    public function view($page='home')
    {
        if(!is_file(APPPATH.  'Views/pages/'.$page.'.php')){
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); //Capitalize the first letter

        return $data;
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
            return false;
        }

        $img = $this->request->getFile('userfile');
        
        if (! $img->hasMoved()) {
           return true;
        }
        
        return false;
    }
    public function cadastrarAtualizarDados()//Função cadastra nova pessoa ou atualiza os dados cadastrais    
    {
        $model = model(NewsModelCadastro::class);
       
        if($this->upload() && $this->request->getPost('btnCadastrar'))
        {
            //Upload de imagem
            $img = $this->request->getFile('userfile');
            $filepath = WRITEPATH . 'uploads/' . $img->store("../../public");
            $data = ['uploaded_flleinfo' => new File($filepath)];
            $nomeImagem = $data['uploaded_flleinfo']->getBasename();

            //Upload do Doc
            $uploadDoc = new UploadDoc();
            $nomeDoc = $uploadDoc->upload($this->request->getFile('file'));

            $upload=true;
        }else if(!$this->upload() && $this->request->getPost('btnCadastrar')){
            $data = ['errors' => $this->validator->getErrors()];
            $data = ['errors' => 'The file has already been moved.'];
            $mensagem = "Erro ao cadastrar";
            $upload=false;
        }
            
            $mensagem ='';
            if($this->request->getMethod() === 'post')
            {
                if($this->request->getPost('id') && $this->request->getPost('btnEditar'))
                {//Se o usuario clicar no botão editar
                    $nomeImagem=$this->request->getPost('imagemName');
                    $nomeDoc = $this->request->getPost('docName');
                    $model->save([
                        'id'=>$this->request->getPost('id'),
                        'nome'=>$this->request->getPost('nome'),
                        'cpf'=>$this->request->getPost('cpf'),
                        'cep'=>$this->request->getPost('cep'),
                        'imagem'=>$nomeImagem,
                        'documento'=>$nomeDoc,
                    ]);
                $mensagem = "Atualizado com sucesso";
                }else if($this->request->getPost('btnCadastrar') && $upload==true)//Se o usuario clicar no botão cadastrar
                {
                    $model->save([
                    'nome'=>$this->request->getPost('nome'),
                    'cpf'=>$this->request->getPost('cpf'),
                    'cep'=>$this->request->getPost('cep'),
                    'imagem'=>$nomeImagem,
                    'documento'=>$nomeDoc,
                ]);
                $mensagem = "Cadastrado com sucesso";
            }
        }
        //Regasta cadastros do banco de dados
        $data['dados']= $model->getDados(); //Chama a função que resgasta o dados do banco banco de dados na camada Model 
        $data['title']='Formulario';
        $data['operacao']='cadastrar';
        $data['mensagem']=$mensagem;

        //Exibe telas
        return view ('templates/header',$data)//Cabeçalho, passa como parametro a variavel $data
            .   view('formularios/formulario')//Formulário
            .   view('tabelas/dadosPessoa')//Tabela
            .   view('templates/footer');//Rodapé
    }
    public function excluirCadastro(){

        $model = model(newsModelCadastro::class);
        $mensagem='';
       if($this->request->getMethod()==='post')
        {
            $id= $this->request->getPost('id');
            $model->delete(['id'=>$id]);
            $mensagem='Excluido com sucesso';
        }

        $data['dados']= $model->getDados();  
        $data['title']='Formulario';
        $data['operacao']='excluir';
        $data['mensagem']=$mensagem;

        return view ('templates/header',$data)
            .   view('formularios/formulario')
            .   view('tabelas/dadosPessoa')
            .   view('templates/footer');
       
    }

    public function editarCadastro(){
        
        $model= model(newsModelCadastro::class);

        $id= $this->request->getPost('id');
        $operacao = 'editar';
    
        $data=[
            'dados'=>$model->getDados($id),
            'title'=>'Formulario',
            'operacao'=>$operacao,
        ];

        return view ('templates/header',$data)
            .   view('formularios/formulario')
            .   view('tabelas/dadosPessoa')
            .   view('templates/footer');

    }

    public function capturar()
    {
        return view('templates/header',['title'=>'Camera']) 
            . view('camera/camera');
    }
}
