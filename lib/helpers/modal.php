<?php
// Obteniendo requerimiento
if (!empty($_GET['req'])) {
    $req = $_GET['req'];
}


// Procesando Requerimiento
$modal = new Modal($req);

$bodyModalHTml = $modal->getModal();
echo $bodyModalHTml;

/**
 * LS clase para Modal
 */
class Modal
{
    public $req;
    
    public function __construct($req) {
        $this->req = $req;
    }
    
    /**
     * Obteniendo un cuerpo modal
     * 
     * @param string $req Requerimiento solicitado
     */
    public function getModal() {
        switch ($this->req) {
            case 'NC':
                ob_start(); ?>
                        <form action="index.php?ladysusycom=com_system&view=roles&task=edit&do=registry&ret=nu" method="post">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-muted font-weight-bold">Name:</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name"> 
                            </div>
                        </div>
                        <br><hr>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ml-auto">Send</button>
                        </div>
                    </form>
                    <?php
                $datosHtml = ob_get_contents();
                ob_end_clean();
            break;
            case 'NU':
                ob_start(); ?>
                        <form action="index.php?ladysusycom=com_system&view=units&task=edit&do=registry&ret=nu" method="post">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-muted font-weight-bold">Name:</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name"> 
                            </div>
                        </div>
                        <br><hr>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ml-auto">Send</button>
                        </div>
                    </form>
                    <?php
                $datosHtml = ob_get_contents();
                ob_end_clean();
            break;
            case 'NTR':
                ob_start(); ?>
                        <form action="index.php?ladysusycom=com_system&view=typereaders&task=edit&do=registry&ret=ntr" method="post">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-muted font-weight-bold">Name:</label>
                            <div class="col-sm-10">
                                <input name="name" type="text" class="form-control" id="name"> 
                            </div>
                        </div>
                        <br><hr>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ml-auto">Send</button>
                        </div>
                    </form>
                    <?php
                $datosHtml = ob_get_contents();
                ob_end_clean();
            break;
        }
        
        return $datosHtml;
    }
}
?>



