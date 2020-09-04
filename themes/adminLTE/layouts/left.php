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
<<<<<<< Updated upstream
=======
        
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                                    'label' => 'Administración',
=======
                                    'label' => 'Contratacion',
>>>>>>> Stashed changes
                                    'icon' => 'database',
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => 'Administración',
                                            'icon' => 'database',
                                            'url' => '#',
                                            'items' => [
                                                
                                                ['label' => 'Banco Empresa', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                                
<<<<<<< Updated upstream
                                                [
                                                'label' => 'Contrato',
                                                'icon' => 'database',
                                                'url' => '#',
                                                'items' => [
                                                    ['label' => 'Arl', 'icon' => 'plus-square-o', 'url' => ['arl/index']],
                                                    ['label' => 'Caja Compensación', 'icon' => 'plus-square-o', 'url' => ['/caja-compensacion/index']],
                                                    ['label' => 'Cargo', 'icon' => 'plus-square-o', 'url' => ['/cargo/index']],
                                                    ['label' => 'Cesantia', 'icon' => 'plus-square-o', 'url' => ['/cesantia/index']],                                                    
                                                    ['label' => 'Centro Trabajo', 'icon' => 'plus-square-o', 'url' => ['/centro-trabajo/index']],
                                                    ['label' => 'Contrato', 'icon' => 'plus-square-o', 'url' => ['/contrato/index']],
                                                    ['label' => 'Entidad Pensión', 'icon' => 'plus-square-o', 'url' => ['/entidad-pension/index']],
                                                    ['label' => 'Entidad Salud', 'icon' => 'plus-square-o', 'url' => ['/entidad-salud/index']],
                                                    ['label' => 'Grupo Pago', 'icon' => 'plus-square-o', 'url' => ['/grupo-pago/index']],
                                                    ['label' => 'Motivo Terminación', 'icon' => 'plus-square-o', 'url' => ['/motivo-terminacion/index']],
                                                    ['label' => 'Tipo Contrato', 'icon' => 'plus-square-o', 'url' => ['tipo-contrato/index']],
                                                    ['label' => 'Tipo Cotizante', 'icon' => 'plus-square-o', 'url' => ['tipo-cotizante/index']],
                                                    ['label' => 'Subtipo Cotizante', 'icon' => 'plus-square-o', 'url' => ['subtipo-cotizante/index']],
                                                ]],
=======
                                                ////
>>>>>>> Stashed changes
                                                [
                                                'label' => 'Empleado',
                                                'icon' => 'database',
                                                'url' => '#',
                                                'items' => [
<<<<<<< Updated upstream
                                                    ['label' => 'Banco Empleado', 'icon' => 'plus-square-o', 'url' => ['/banco-empleado/index']],
                                                    ['label' => 'Centro Costo', 'icon' => 'plus-square-o', 'url' => ['/centro-costo/index']],
                                                    ['label' => 'Empleado', 'icon' => 'plus-square-o', 'url' => ['/empleado/index']],
                                                    ['label' => 'Sucursal', 'icon' => 'plus-square-o', 'url' => ['/sucursal/index']],
                                                ]],
                                                                                                
                                                ['label' => 'Cliente', 'icon' => 'plus-square-o', 'url' => ['/clientes/index']],
=======
                                                    ['label' => 'Empleado', 'icon' => 'plus-square-o', 'url' => ['/empleado/indexempleado']],
                                                    ['label' => 'Estudios', 'icon' => 'plus-square-o', 'url' => ['/estudio-empleado/index']],
                                                    ['label' => 'Banco Empleado', 'icon' => 'plus-square-o', 'url' => ['/banco-empleado/index']],
                                                    ['label' => 'Centro Costo', 'icon' => 'plus-square-o', 'url' => ['/centro-costo/index']],
                                                    ['label' => 'Sucursal', 'icon' => 'plus-square-o', 'url' => ['/sucursal/index']],
                                                ]],
                                                                                                
>>>>>>> Stashed changes
                                                ['label' => 'Departamento', 'icon' => 'plus-square-o', 'url' => ['/departamento/index']],                                                                                                
                                                ['label' => 'Horario', 'icon' => 'plus-square-o', 'url' => ['/horario/index']],                                                
                                                ['label' => 'Municipio', 'icon' => 'plus-square-o', 'url' => ['/municipio/index']],
                                                ['label' => 'Resolución', 'icon' => 'plus-square-o', 'url' => ['/resolucion/index']],                                                                                                
                                                ['label' => 'Tipo Documento', 'icon' => 'plus-square-o', 'url' => ['/tipo-documento/index']],
                                                ['label' => 'Tipo Cargo', 'icon' => 'plus-square-o', 'url' => ['tipocargo/index']],
                                                
                                                
                                            ],
                                        ],
                                        [
                                            'label' => 'Utilidades',
                                            'icon' => 'cube',
                                            'url' => '#',
                                            'items' => [
<<<<<<< Updated upstream
=======
                                            ['label' => 'Configuracion salario', 'icon' => 'plus-square-o', 'url' => ['/configuracion-salario/index']],                                            
                                            ],
                                        ],
                                        [
                                            'label' => 'Consultas',
                                            'icon' => 'question',
                                            'url' => '#',
                                            'items' => [
                                              //  ['label' => 'Cliente', 'icon' => 'plus-square-o', 'url' => ['/clientes/indexconsulta']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Procesos',
                                            'icon' => 'exchange',
                                            'url' => '#',
                                            'items' => [
>>>>>>> Stashed changes
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                            
                                            ],
                                        ],
                                        [
<<<<<<< Updated upstream
=======
                                            'label' => 'Movimientos',
                                            'icon' => 'book',
                                            'url' => '#',
                                            'items' => [
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],   
                                                [
                                                'label' => 'Contrato',
                                                'icon' => 'database',
                                                'url' => '#',
                                                'items' => [
                                                    ['label' => 'Arl', 'icon' => 'plus-square-o', 'url' => ['arl/index']],
                                                    ['label' => 'Caja Compensación', 'icon' => 'plus-square-o', 'url' => ['/caja-compensacion/index']],
                                                    ['label' => 'Cargo', 'icon' => 'plus-square-o', 'url' => ['/cargo/index']],
                                                    ['label' => 'Cesantia', 'icon' => 'plus-square-o', 'url' => ['/cesantia/index']],                                                    
                                                    ['label' => 'Centro Trabajo', 'icon' => 'plus-square-o', 'url' => ['/centro-trabajo/index']],
                                                    ['label' => 'Contrato', 'icon' => 'plus-square-o', 'url' => ['/contrato/index']],
                                                    ['label' => 'Entidad Pensión', 'icon' => 'plus-square-o', 'url' => ['/entidad-pension/index']],
                                                    ['label' => 'Entidad Salud', 'icon' => 'plus-square-o', 'url' => ['/entidad-salud/index']],
                                                    ['label' => 'Motivo Terminación', 'icon' => 'plus-square-o', 'url' => ['/motivo-terminacion/index']],
                                                    ['label' => 'Tipo Contrato', 'icon' => 'plus-square-o', 'url' => ['tipo-contrato/index']],
                                                    ['label' => 'Tiempo servicio', 'icon' => 'plus-square-o', 'url' => ['tiempo-servicio/index']],
                                                    ['label' => 'Tipo Cotizante', 'icon' => 'plus-square-o', 'url' => ['tipo-cotizante/index']],
                                                    ['label' => 'Subtipo Cotizante', 'icon' => 'plus-square-o', 'url' => ['subtipo-cotizante/index']],
                                                ]],
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
>>>>>>> Stashed changes
                                            'label' => 'Consultas',
                                            'icon' => 'question',
                                            'url' => '#',
                                            'items' => [
<<<<<<< Updated upstream
                                                ['label' => 'Cliente', 'icon' => 'plus-square-o', 'url' => ['/clientes/indexconsulta']],
=======
                                                ['label' => 'Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/indexconsulta']],
                                                ['label' => 'Ficha Tiempo', 'icon' => 'plus-square-o', 'url' => ['fichatiempo/indexconsulta']],
                                                ['label' => 'Seguimiento Producción', 'icon' => 'plus-square-o', 'url' => ['seguimiento-produccion/indexconsulta']],
                                                ['label' => 'Ficha Operaciones', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/indexconsultaficha']],
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                                            //['label' => 'Banco', 'icon' => 'plus-square-o', 'url' => ['/banco/index']],                                            
=======
                                                ['label' => 'Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/index']],
                                                ['label' => 'Ficha Operaciones', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/proceso']],
                                            ],
                                        ],
                                    ],
                                ], // termina el menu produccion
                                
                                // comienza en menu de nomina
                                [
                                    'label' => 'Nomina',
                                    'icon' => 'money',
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => 'Administración',
                                            'icon' => 'database',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Concepto salarios', 'icon' => 'plus-square-o', 'url' => ['concepto-salarios/index']],
                                                ['label' => 'Configuracion pension', 'icon' => 'plus-square-o', 'url' => ['configuracion-pension/index']],
                                                ['label' => 'Configuracion eps', 'icon' => 'plus-square-o', 'url' => ['configuracion-eps/index']],
                                                ['label' => 'Configuracion de credito', 'icon' => 'plus-square-o', 'url' => ['/configuracion-credito/index']],
                                                ['label' => 'Periodo Pago', 'icon' => 'plus-square-o', 'url' => ['/periodo-pago/index']],
                                                ['label' => 'Grupo Pago', 'icon' => 'plus-square-o', 'url' => ['/grupo-pago/index']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Movimiento',
                                            'icon' => 'book',
                                            'url' => '#',
                                            'items' => [
                                              ['label' => 'Programacion nómina', 'icon' => 'plus-square-o', 'url' => ['/programacion-nomina/index']],
                                              ['label' => 'Prestaciones sociales', 'icon' => 'plus-square-o', 'url' => ['/prestaciones-sociales/index']],  
                                            ],
                                        ],
                                        [
                                            'label' => 'Consultas',
                                            'icon' => 'question',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Comprobante de pago', 'icon' => 'plus-square-o', 'url' => ['/programacion-nomina/comprobantepagonomina']],
                                                ['label' => 'Liquidaciones', 'icon' => 'plus-square-o', 'url' => ['/prestaciones-sociales/comprobantepagoprestaciones']],

                                            ],
                                        ],
                                        [
                                            'label' => 'Procesos',
                                            'icon' => 'exchange',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Pago adicional permanente', 'icon' => 'plus-square-o', 'url' => ['/pago-adicional-permanente/index']],                                            
                                                ['label' => 'Pago adicional fechas', 'icon' => 'plus-square-o', 'url' => ['/pago-adicional-fecha/index']],                                            
                                                ['label' => 'Créditos', 'icon' => 'plus-square-o', 'url' => ['/credito/index']],                                            
                                            ],
                                        ],
                                        [
                                            'label' => 'Utilidades',
                                            'icon' => 'cube',
                                            'url' => '#',
                                            'items' => [
                                              
                                                ['label' => 'Periodo de nomina', 'icon' => 'plus-square-o', 'url' => ['/periodo-nomina/indexconsulta']],
>>>>>>> Stashed changes
                                            ],
                                        ],
                                    ],
                                ],
<<<<<<< Updated upstream
                                [
                                    'label' => 'Produccion',
                                    'icon' => 'flask',
=======
                                //termina el menu de nomina
                                // comienza el menu de salud ocupacional
                                [
                                    'label' => 'Sg - Sst',
                                    'icon' => 'medkit',
>>>>>>> Stashed changes
                                    'url' => '#',
                                    'items' => [
                                        [
                                            'label' => 'Administración',
                                            'icon' => 'database',
                                            'url' => '#',
                                            'items' => [
<<<<<<< Updated upstream
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
=======
                                                ['label' => 'Configuracion licencias', 'icon' => 'plus-square-o', 'url' => ['configuracion-licencia/index']],
                                                ['label' => 'Configuracion incapacidades', 'icon' => 'plus-square-o', 'url' => ['configuracion-incapacidad/index']],                                               
                                                ['label' => 'Diagnostico', 'icon' => 'plus-square-o', 'url' => ['diagnostico-incapacidad/index']],
                                                ['label' => 'Sintomas Covid', 'icon' => 'plus-square-o', 'url' => ['sintomas-covid/index']],
                                            ],
                                        ],
                                        [
                                            'label' => 'Movimiento',
                                            'icon' => 'book',
                                            'url' => '#',
                                            'items' => [
                                              ['label' => 'Incapacidades', 'icon' => 'plus-square-o', 'url' => ['/incapacidad/index']],
                                              ['label' => 'Licencias', 'icon' => 'plus-square-o', 'url' => ['/licencia/index']],
                                              ['label' => 'Control Acceso Covid', 'icon' => 'plus-square-o', 'url' => ['control-acceso/index']],
>>>>>>> Stashed changes
                                            ],
                                        ],
                                        [
                                            'label' => 'Consultas',
                                            'icon' => 'question',
                                            'url' => '#',
                                            'items' => [
<<<<<<< Updated upstream
                                                ['label' => 'Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/indexconsulta']],
                                                ['label' => 'Ficha Tiempo', 'icon' => 'plus-square-o', 'url' => ['fichatiempo/indexconsulta']],
                                                ['label' => 'Seguimiento Producción', 'icon' => 'plus-square-o', 'url' => ['seguimiento-produccion/indexconsulta']],
                                                ['label' => 'Ficha Operaciones', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/indexconsultaficha']],
=======
                                               // ['label' => 'Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/indexconsulta']],

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                                            'label' => 'Movimientos',
                                            'icon' => 'book',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Orden Producción', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/index']],
                                                ['label' => 'Ficha Operaciones', 'icon' => 'plus-square-o', 'url' => ['/orden-produccion/proceso']],
=======
                                            'label' => 'Utilidades',
                                            'icon' => 'cube',
                                            'url' => '#',
                                            'items' => [                                              
                                                ['label' => 'Periodo de nomina', 'icon' => 'plus-square-o', 'url' => ['/periodo-nomina/indexconsulta']],
                                                ['label' => 'Control Acceso Covid', 'icon' => 'plus-square-o', 'url' => ['control-acceso/validar']],
>>>>>>> Stashed changes
                                            ],
                                        ],
                                    ],
                                ],
<<<<<<< Updated upstream
=======
                                 
                                //termina el menu de salud ocupacional
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
=======
                                                ['label' => 'Cliente', 'icon' => 'plus-square-o', 'url' => ['/clientes/index']],
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
=======
                                                ['label' => 'Cliente', 'icon' => 'plus-square-o', 'url' => ['/clientes/indexconsulta']],
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
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
=======
                                    ],
                                ],
                                [
                                    'label' => 'General',
                                    'icon' => 'wrench',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Configuración', 'icon' => 'cog', 'url' => ['parametros/parametros', 'id' => 1]],
                                        ['label' => 'Empresa', 'icon' => 'nav-icon fas fa-file', 'url' => ['empresa/empresa', 'id' => 1]],
                                         [
                                        'label' => 'Contenido',
                                        'icon' => 'comment',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Formato principal', 'icon' => 'tumblr-square', 'url' => ['formato-contenido/index']],
                                        ]],
                                    ],
                                ],
                                 
>>>>>>> Stashed changes
                            ],
                        ],
                    ],
                ]
        )
        ?>

    </section>

</aside>
