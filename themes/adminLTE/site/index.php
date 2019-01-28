<?php
use app\models\Matriculaempresa;
/* @var $this yii\web\View */



?>
<?php $empresa = Matriculaempresa::findOne(901189320) ;
$this->title = $empresa->nombresistema; ?>
<div class="site-index">

    <div class="jumbotron">
        <img src="dist/images/logo.png" align="center" >
        <h1>Bienvenidos!</h1>

        <p class="lead"><?= $empresa->nombresistema ?></p>


    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-16">

            </div>


        </div>

    </div>
</div>
