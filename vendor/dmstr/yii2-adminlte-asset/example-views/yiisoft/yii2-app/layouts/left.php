<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

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
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Administración',
                                'icon' => 'database',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Clientes', 'icon' => 'plus-square-o', 'url' => '/clientes/index',],
                                    ['label' => 'Productos', 'icon' => 'plus-square-o', 'url' => '#',],
                                    ['label' => 'Tipo Documento', 'icon' => 'plus-square-o', 'url' => 'banco/index',],
                                    ['label' => 'Tipo Orden Produccion', 'icon' => 'plus-square-o', 'url' => 'banco/index',],
                                    ['label' => 'Prenda', 'icon' => 'plus-square-o', 'url' => 'banco/index',],
                                    ['label' => 'Talla', 'icon' => 'plus-square-o', 'url' => 'banco/index',],
                                    ['label' => 'Bancos', 'icon' => 'plus-square-o', 'url' => 'banco/index',],
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
                                    ['label' => 'Orden Producción', 'icon' => 'plus-square-o', 'url' => '#',],
                                    ['label' => 'Factura Venta', 'icon' => 'plus-square-o', 'url' => '#',],
                                    ['label' => 'Recibo Caja', 'icon' => 'plus-square-o', 'url' => '#',],
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
