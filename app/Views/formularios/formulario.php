<?=session()->getFlashdata('error')?><!--Função é usada para relatar erros relacionados a proteção CSRF-->
<?=service('validation')->listErrors()?><!--Função é usada para relatar erros relacionados a validação do formulario-->

<div class="container">
    <p class="text-primary"><?php echo isset($mensagem)?$mensagem:'';  ?></p>
<?php if($operacao=='cadastrar' || $operacao=='excluir'){?>
    <h1 class="display-5 text-center text-primary">Formulário de Cadastro</h1>
    <form action="/formularios/formulario" enctype="multipart/form-data" method="post" accept-charset="utf-8">  
<?=csrf_field()?>
        <div class="mb-3">
            <label for="nome">Nome : </label>
            <input type="text" name="nome"  class="form-control" required/>
        </div>
        <div class="mb-3">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" class="form-control"  onKeyPress="MascaraGenerica(this, 'CPF');" placeholder="000.000.000-00" required/>
            <label for="cep">CEP : </label>
            <input type="text" name="cep" class="form-control" onKeyPress="MascaraGenerica(this, 'CEP');" placeholder="00000-00" required/>
        </div>
        <div class="mb-3">
            <label for="userfile">Imagem</label>
            <input type='file' class="form-control"  name="userfile" required/>
        </div>
        <div class="mb-3">
            <label for="file">Documento pdf</label>
            <input type='file'  class="form-control"  name='file' required/>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="submit" value="Cadastrar" name="btnCadastrar" class="btn btn-outline-primary  col-4"/>
        </div>
    </form>
<?php }else if($operacao=='editar'){?>
    <form action="/formularios/formulario/" method="post">
<?=csrf_field()?>
        <img src="<?=base_url($dados[0]['imagem'])?>" width="100px" class=""/>
        <input type="hidden" name="id" value="<?php echo $dados[0]['id']; ?>" required/>
        <div class="mb-3">
            <label for="nome">Nome : </label>
            <input type="text" name="nome"  class="form-control" value="<?php echo $dados[0]['nome']; ?>" required/>
        </div>
        <div class="mb-3">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf"  class="form-control" value="<?php echo $dados[0]['cpf']; ?>" placeholder="000.000.000-00" required/>
        </div>
        <div class="mb-3">
            <label for="cep">CEP : </label>
            <input type="text" name="cep"  class="form-control" value="<?php echo $dados[0]['cep']; ?>"placeholder="00000-00" required/>
        </div>
        <input type='hidden' name="imagemName" value="<?php echo $dados[0]['imagem'];?>"/>
        <input type='hidden' name="docName" value="<?php echo $dados[0]['documento'];?>"/>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <input type="submit" value="Editar" name="btnEditar" class="btn btn-outline-primary  col-4"/>
        </div>
    </form>
<?php }?>
