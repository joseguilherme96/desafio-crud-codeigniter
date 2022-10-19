<table class="table">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Id</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>CEP</th>
            <th>Documento</th>
        </tr>
        <?php 
                foreach($dados as $linha){
        ?>
        <tr>
            <td><img src="<?=base_url($linha['imagem']);?>" width="100"></td>
            <td><?php echo $linha['id'] ?></td>
            <td><?php echo $linha['nome'] ?></td>
            <td><?php echo $linha['cpf'] ?></td>
            <td><?php echo $linha['cep'] ?></td>
            <td><a href="<?=base_url($linha['documento']);?>" target="_blank"><?php echo $linha['documento'] ?></a></td>
            <td>
                <form action="/formularios/formulario/excluir" method="post">
                    <?=csrf_field()?>
                    <input type="hidden" name="id" value="<?php echo $linha['id'] ?>"/>    
                    <input type="submit" value="Excluir" class="btn btn-outline-primary" name='excluir'>
                </form>
            </td>
            <td>
                <form action='/formularios/formulario/editar' method="post">
                    <?=csrf_field()?> 
                    <input type="hidden" name="id" value="<?php echo $linha['id'] ?>"/>
                    <input type="submit" value="Editar" class="btn btn-outline-primary" name='editar'>
                </form>
            </td>
        </tr>
       
        <?php 
                }
            
        ?>
    </thead>
</table>