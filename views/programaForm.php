<div class="container">
    <form autocomplete="off" id="formRegistroProgramasAlimentarios" name="formRegistroProgramasAlimentarios" action="" method="POST">

        <h1><?php if(isset($_POST['nombreProgramaAlimentarioOriginal'])){ echo "Editar Programa"; } else { echo "Registrar Programa"; } ?></h1>

        
        <div class="input <?php if(isset($nombreEnUso)){ echo "shake"; } ?>">
            <input type="text" name="nombreProgramaAlimentario" id="nombreProgramaAlimentario" placeholder="Nombre del programa alimentario" <?php echo "value='$nombreProgramaAlimentario'" ?>>
            <?php
                if(isset($nombreEnUso)){
                    ?>
                    <label for="nombreProgramaAlimentario" class="error">
                        <strong>El nombre elegido ya está seleccionado</strong>
                    </label>
                    <?php
                }
            ?>
        </div>

        <input onclick="validarCamposPrograma()" type="button" class="button" value="Guardar">
        <?php
        if (isset($_POST['nombreProgramaAlimentarioOriginal'])) {
        ?>
        <input type='hidden' name='nombreProgramaAlimentarioOriginal' id='nombreProgramaAlimentarioOriginal' value="<?php echo $_POST['nombreProgramaAlimentarioOriginal'] ?>"
            size='30'>
        <?php
        }
        ?>
        <script type="text/javascript" src="public/js/validarCamposPrograma.js"></script>
    </form>
</div>