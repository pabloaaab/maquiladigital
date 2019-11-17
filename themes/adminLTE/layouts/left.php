<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/avatar5.png" class="img-circle" alt="User Image"/>
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

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
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
                                        [
                                            'label' => 'Administración',
                                            'icon' => 'database',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Arl', 'icon' => 'plus-square-o', 'url' => ['arl/index']],
                                                ['label' => 'Banco Empresa', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],
                                                ['label' => 'Banco Empleado', 'icon' => 'plus-square-o', 'url' => ['/banco-empleado/index']],
                                                ['label' => 'Cargo', 'icon' => 'plus-square-o', 'url' => ['/cargo/index']],
                                                ['label' => 'Caja Compensación', 'icon' => 'plus-square-o', 'url' => ['/caja-compensacion/index']],
                                                ['label' => 'Cesantia', 'icon' => 'plus-square-o', 'url' => ['/cesantia/index']],
                                                ['label' => 'Centro Costo', 'icon' => 'plus-square-o', 'url' => ['/centro-costo/index']],
                                                ['label' => 'Centro Trabajo', 'icon' => 'plus-square-o', 'url' => ['/centro-trabajo/index']],
                                                ['label' => 'Contrato', 'icon' => 'plus-square-o', 'url' => ['/contrato/index']],
                                                ['label' => 'Cliente', 'icon' => 'plus-square-o', 'url' => ['/clientes/index']],
                                                ['label' => 'Departamento', 'icon' => 'plus-square-o', 'url' => ['/departamento/index']],
                                                ['label' => 'Entidad Pensión', 'icon' => 'plus-square-o', 'url' => ['/entidad-pension/index']],
                                                ['label' => 'Entidad Salud', 'icon' => 'plus-square-o', 'url' => ['/entidad-salud/index']],
                                                ['label' => 'Empleado', 'icon' => 'plus-square-o', 'url' => ['/empleado/index']],
                                                ['label' => 'Horario', 'icon' => 'plus-square-o', 'url' => ['/horario/index']],
                                                ['label' => 'Motivo Terminación', 'icon' => 'plus-square-o', 'url' => ['/motivo-terminacion/index']],
                                                ['label' => 'Municipio', 'icon' => 'plus-square-o', 'url' => ['/municipio/index']],
                                                ['label' => 'Resolución', 'icon' => 'plus-square-o', 'url' => ['/resolucion/index']],
                                                ['label' => 'Sucursal', 'icon' => 'plus-square-o', 'url' => ['/sucursal/index']],
                                                ['label' => 'Subtipo Cotizante', 'icon' => 'plus-square-o', 'url' => ['subtipo-cotizante/index']],
                                                ['label' => 'Tipo Documento', 'icon' => 'plus-square-o', 'url' => ['/tipo-documento/index']],
                                                ['label' => 'Tipo Cargo', 'icon' => 'plus-square-o', 'url' => ['tipocargo/index']],
                                                ['label' => 'Tipo Contrato', 'icon' => 'plus-square-o', 'url' => ['tipo-contrato/index']],
                                                ['label' => 'Tipo Cotizante', 'icon' => 'plus-square-o', 'url' => ['tipo-cotizante/index']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Utilidades',
                                            'icon' => 'cube',
                                            'url' => '#',
                                            'items' => [
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                            
                                            ],
                                        ],
                                        [
                                            'label' => 'Consultas',
                                            'icon' => 'question',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Cliente', 'icon' => 'plus-square-o', 'url' => ['/clientes/indexconsulta']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Procesos',
                                            'icon' => 'exchange',
                                            'url' => '#',
                                            'items' => [
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                            
                                            ],
                                        ],
                                        [
                                            'label' => 'Movimientos',
                                            'icon' => 'book',
                                            'url' => '#',
                                            'items' => [
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                            
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => 'Produccion',
                                    'icon' => 'flask',
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => 'Administración',
                                            'icon' => 'database',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Prenda', 'icon' => 'plus-square-o', 'url' => ['prendatipo/index']],
                                                ['label' => 'Talla', 'icon' => 'plus-square-o', 'url' => ['talla/index']],
                                                ['label' => 'Operación Producción', 'icon' => 'plus-square-o', 'url' => ['proceso-produccion/index']],
                                                ['label' => 'Tipo Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/ordenproducciontipo/index']],
                                                ['label' => 'Productos', 'icon' => 'plus-square-o', 'url' => ['/producto/index']],
                                                ['label' => 'Calificación Ficha', 'icon' => 'plus-square-o', 'url' => ['/fichatiempocalificacion/index']],
                                                ['label' => 'Colores', 'icon' => 'plus-square-o', 'url' => ['/color/index']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Utilidades',
                                            'icon' => 'cube',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Costo Laboral', 'icon' => 'plus-square-o', 'url' => ['costo-laboral/costolaboraldetalle', 'id' => 1]],
                                                ['label' => 'Costo Laboral Hora', 'icon' => 'plus-square-o', 'url' => ['costo-laboral-hora/costolaboralhora', 'id' => 1]],
                                                ['label' => 'Costo Fijo', 'icon' => 'plus-square-o', 'url' => ['costo-fijo/costofijodetalle', 'id' => 1]],
                                                ['label' => 'Costo Prod Diaria', 'icon' => 'plus-square-o', 'url' => ['costo-produccion-diaria/costodiario']],
                                                ['label' => 'Resumen Costos', 'icon' => 'plus-square-o', 'url' => ['resumen-costos/resumencostos', 'id' => 1]],
                                                ['label' => 'Ficha Tiempo', 'icon' => 'plus-square-o', 'url' => ['fichatiempo/index']],
                                                ['label' => 'Seguimiento Producción', 'icon' => 'plus-square-o', 'url' => ['seguimiento-produccion/index']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Consultas',
                                            'icon' => 'question',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/indexconsulta']],
                                                ['label' => 'Ficha Tiempo', 'icon' => 'plus-square-o', 'url' => ['fichatiempo/indexconsulta']],
                                                ['label' => 'Seguimiento Producción', 'icon' => 'plus-square-o', 'url' => ['seguimiento-produccion/indexconsulta']],
                                                ['label' => 'Ficha Operaciones', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/indexconsultaficha']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Procesos',
                                            'icon' => 'exchange',
                                            'url' => '#',
                                            'items' => [
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                            
                                            ],
                                        ],
                                        [
                                            'label' => 'Movimientos',
                                            'icon' => 'book',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/index']],
                                                ['label' => 'Ficha Operaciones', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/proceso']],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => 'Contabilidad',
                                    'icon' => 'bank',
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => 'Administración',
                                            'icon' => 'database',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Cuentas', 'icon' => 'plus-square-o', 'url' => ['/cuenta-pub/index']],
                                                ['label' => 'Tipo Recibo', 'icon' => 'plus-square-o', 'url' => ['/tipo-recibo/index']],
                                                ['label' => 'Tipo Compra', 'icon' => 'plus-square-o', 'url' => ['/compra-tipo/index']],
                                                ['label' => 'Concepto Compra', 'icon' => 'plus-square-o', 'url' => ['/compra-concepto/index']],
                                                ['label' => 'Tipo Comprobante Egreso', 'icon' => 'plus-square-o', 'url' => ['/comprobante-egreso-tipo/index']],
                                                ['label' => 'Tipo Comprobante (Exportar)', 'icon' => 'plus-square-o', 'url' => ['/contabilidad-comprobante-tipo/index']],
                                                ['label' => 'Proveedor', 'icon' => 'plus-square-o', 'url' => ['/proveedor/index']],
                                                ['label' => 'Doc Equivalente', 'icon' => 'plus-square-o', 'url' => ['/documento-equivalente/index']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Utilidades',
                                            'icon' => 'cube',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Contabiizar', 'icon' => 'plus-square-o', 'url' => ['/contabilizar/contabilizar']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Consultas',
                                            'icon' => 'question',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Recibo Caja', 'icon' => 'plus-square-o', 'url' => ['/recibocaja/indexconsulta']],
                                                ['label' => 'Compras', 'icon' => 'plus-square-o', 'url' => ['/compra/indexconsulta']],
                                                ['label' => 'Comprobante Egreso', 'icon' => 'plus-square-o', 'url' => ['/comprobante-egreso/indexconsulta']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Procesos',
                                            'icon' => 'exchange',
                                            'url' => '#',
                                            'items' => [
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                            
                                            ],
                                        ],
                                        [
                                            'label' => 'Movimientos',
                                            'icon' => 'book',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Recibo Caja', 'icon' => 'plus-square-o', 'url' => ['/recibocaja/index']],
                                                ['label' => 'Compras', 'icon' => 'plus-square-o', 'url' => ['/compra/index']],
                                                ['label' => 'Comprobante Egreso', 'icon' => 'plus-square-o', 'url' => ['/comprobante-egreso/index']],
                                            ],
                                        ]
                                    ],
                                ],
                                [
                                    'label' => 'Facturacion',
                                    'icon' => 'dollar',
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => 'Administración',
                                            'icon' => 'database',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Conceptos Notas', 'icon' => 'plus-square-o', 'url' => ['conceptonota/index']],
                                                ['label' => 'Factura de Venta Tipo', 'icon' => 'plus-square-o', 'url' => ['facturaventatipo/index']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Utilidades',
                                            'icon' => 'cube',
                                            'url' => '#',
                                            'items' => [
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                            
                                            ],
                                        ],
                                        [
                                            'label' => 'Consultas',
                                            'icon' => 'question',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Factura Venta', 'icon' => 'plus-square-o', 'url' => ['/facturaventa/indexconsulta']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Procesos',
                                            'icon' => 'exchange',
                                            'url' => '#',
                                            'items' => [
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                            
                                            ],
                                        ],
                                        [
                                            'label' => 'Movimientos',
                                            'icon' => 'book',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Factura Venta', 'icon' => 'plus-square-o', 'url' => ['/facturaventa/index']],
                                                ['label' => 'Nota Crédito', 'icon' => 'plus-square-o', 'url' => ['/notacredito/index']],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'label' => 'General',
                                    'icon' => 'wrench',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Configuración', 'icon' => 'cog', 'url' => ['parametros/parametros', 'id' => 1]],
                                        ['label' => 'Empresa', 'icon' => 'cog', 'url' => ['empresa/empresa', 'id' => 1]],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
        )
        ?>

    </section>

</aside>
