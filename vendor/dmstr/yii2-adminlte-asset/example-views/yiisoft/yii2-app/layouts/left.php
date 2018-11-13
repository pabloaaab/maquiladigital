<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/default-50x50.gif" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->nombrecompleto ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'MENÚ PRINCIPAL', 'options' => ['class' => 'header']],
                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => ' Herramientas ',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Administración',
                                'icon' => 'database',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Cliente', 'icon' => 'plus-square-o', 'url' => ['/clientes/index']],
                                    ['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],
                                    ['label' => 'Productos', 'icon' => 'plus-square-o', 'url' => ['/producto/index']],
                                    ['label' => 'Tipo Documento', 'icon' => 'plus-square-o', 'url' => ['/tipo-documento/index']],
                                    ['label' => 'Tipo Recibo', 'icon' => 'plus-square-o', 'url' => ['/tipo-recibo/index']],
                                    ['label' => 'Tipo Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/ordenproducciontipo/index']],
                                    ['label' => 'Resolución', 'icon' => 'plus-square-o', 'url' => ['/resolucion/index']],
                                    ['label' => 'Departamento', 'icon' => 'plus-square-o', 'url' => ['/departamento/index']],
                                    ['label' => 'Municipio', 'icon' => 'plus-square-o', 'url' => ['/municipio/index']],
                                    ['label' => 'Prenda', 'icon' => 'plus-square-o', 'url' => ['prendatipo/index']],
                                    ['label' => 'Talla', 'icon' => 'plus-square-o', 'url' => ['talla/index']],
                                    ['label' => 'Procesos Producción', 'icon' => 'plus-square-o', 'url' => ['proceso-produccion/index']],
                                    ['label' => 'Conceptos Notas', 'icon' => 'plus-square-o', 'url' => ['conceptonota/index']],
                                ],
                            ],
                            [
                                'label' => 'Utilidades',
                                'icon' => 'cube',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Otros', 'icon' => 'plus-square-o', 'url' => '#',],
                                ],
                            ],
                            [
                                'label' => 'Procesos',
                                'icon' => 'exchange',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Otros', 'icon' => 'plus-square-o', 'url' => '#',],
                                ],
                            ],
                            [
                                'label' => 'Movimientos',
                                'icon' => 'book',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/index']],
                                    ['label' => 'Factura Venta', 'icon' => 'plus-square-o', 'url' => ['/facturaventa/index']],
                                    ['label' => 'Nota Crédito', 'icon' => 'plus-square-o', 'url' => ['/notacredito/index']],
                                    ['label' => 'Recibo Caja', 'icon' => 'plus-square-o', 'url' => ['/recibocaja/index']],
                                    ['label' => 'Procesos Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/proceso']],
                                ],
                            ],
                            [
                                'label' => 'General',
                                'icon' => 'wrench',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Configuración', 'icon' => 'cog', 'url' => '#',],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
