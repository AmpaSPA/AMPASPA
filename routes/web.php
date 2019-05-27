<?php

/**
 * PHP VERSION 7.2.5
 *
 * @category PHP
 * @package  Ampaspa
 * @author   Luis Ponce Melero <lpmelero@gmail.com>
 */

/**
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

/**
 *  RUTAS DE LA AUTENTICACION DE USUARIOS
 *  -------------------------------------
 */
/** Authentication Routes */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

/** Registration Routes */
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

/** Password Reset Routes */
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/**
 *  RUTAS DEL FRONTEND
 *  ------------------
 */
/** Home */
Route::get('/', 'Frontend\HomeController@index');

/** Contacto */
Route::view('contacto', 'frontend.principal.contacto');
Route::post('contacto', 'Frontend\ContactoController@send');

/**
 * RUTAS DEL HOME DEL SOCIO (BACKEND)
 * ----------------------------------
 */
/** Home */
Route::get('home', 'Backend\HomeController@index')->name('home');
Route::get('home/autorizaciones', 'Backend\HomeController@panelAutorizaciones')->name('home.autorizaciones');
Route::get('home/autorizaciones/{alumno}', 'Backend\HomeController@autorizarSeleccion')->name('home.autorizaralumno');
Route::get('home/autorizacionesalumno/{alumno}', 'Backend\HomeController@autorizarSeleccion')
    ->name('home.autorizacionesalumno');
Route::get('home/autorizaciones/{alumno}/{actividad}', 'Backend\HomeController@autorizarActividad')
    ->name('home.autorizaractividad');
Route::get('home/avisos', 'Backend\HomeController@panelAvisos')->name('home.avisos');
Route::get('home/avisos/cerrar/{aviso}/{codigo}', 'Backend\HomeController@cerrarAviso')->name('home.cerraraviso');
Route::view('home/notificaciones', 'backend.home.notificaciones')->name('home.notificaciones');
Route::get('home/notificaciones/tiponotificacionesdata', 'Backend\HomeController@tipoNotificacionesData')
    ->name('home.tiponotificacionesdata');
Route::get('home/notificaciones/tipo/{notificacion}', 'Backend\HomeController@notificacionesTipo')
    ->name('home.notificacionestipo');
Route::get('home/notificaciones/tipo/leer/{notificacion}', 'Backend\HomeController@notificacionesTipoLeer')
    ->name('home.notificacionestipoleer');
Route::get('home/notificaciones/tipo/marcar/{notificacion}', 'Backend\HomeController@notificacionesTipoMarcarLeida')
    ->name('home.notificacionesmarcar');
Route::get('home/notificaciones/vencida/{notificacion}', 'Backend\HomeController@notificacionesVencida')
    ->name('home.notificacionesvencida');

/**
 *  RUTAS DEL BACKEND: PARTE ADMINISTRATIVA DE LA APLICACIÓN
 *  --------------------------------------------------------
 */
/** Useraccounts */
Route::view('backend/useraccounts', 'backend.useraccounts.index')->name('accounts.index');
Route::get('backend/useraccounts/usersdata', 'Backend\UserAccountsController@usersdata')->name('accounts.accountsdata');
Route::get('backend/useraccounts/asignarrol/usuario/{usuario}', 'Backend\UserAccountsController@asignarrolausuario')
    ->name('accounts.asignarroles');
Route::get('backend/useraccounts/{usuario}/attach/{rol}', 'Backend\UserAccountsController@attach')
    ->name('accounts.asignarrol');
Route::get(
    'backend/useraccounts/desasignarrol/usuario/{usuario}',
    'Backend\UserAccountsController@desasignarrolausuario'
)->name('accounts.desasignarroles');
Route::get('backend/useraccounts/{usuario}/detach/{rol}', 'Backend\UserAccountsController@detach');

/** Roles */
Route::view('backend/roles', 'backend.roles.index')->name('roles.list');
Route::get('backend/roles/rolesdata', 'Backend\RolesController@rolesdata')->name('roles.rolesdata');
Route::get('backend/roles/create', 'Backend\RolesController@create')->name('roles.create');
Route::post('backend/roles/nuevorol', 'Backend\RolesController@store');
Route::get('backend/roles/edit/{rol}', 'Backend\RolesController@edit')->name('roles.edit');
Route::patch('backend/roles/update/{rol}', 'Backend\RolesController@update')->name('roles.update');
Route::get('backend/roles/destroy/{rol}', 'Backend\RolesController@destroy')->name('roles.destroy');
Route::get('backend/roles/borrar/{rol}', 'Backend\RolesController@delete')->name('roles.borrar');
Route::get('backend/roles/{usuario}/detach/{rol}', 'Backend\RolesController@detach');

/** Permisos */
Route::view('backend/permisos', 'backend.permisos.index')->name('permisos.list');
Route::get('backend/permisos/permisosdata', 'Backend\PermisosController@permisosdata')->name('permisos.permisosdata');
Route::get('backend/permisos/userspermissionsdata', 'Backend\PermisosController@userspermissionsdata')
    ->name('permisos.usersdata');
Route::get('backend/permisos/asignarpermiso/usuario/{usuario}', 'Backend\PermisosController@asignarpermisoausuario')
    ->name('permisos.asignarpermisos');
Route::get('backend/permisos/{usuario}/attach/{permiso}', 'Backend\PermisosController@otorgarpermiso');
Route::get(
    'backend/permisos/desasignarpermiso/usuario/{usuario}',
    'Backend\PermisosController@desasignarpermisoausuario'
)->name('permisos.desasignarpermisos');
Route::view('backend/permisos/create', 'backend.permisos.create')->name('permisos.create');
Route::post('backend/permisos/nuevopermiso', 'Backend\PermisosController@store');
Route::get('backend/permisos/edit/{permiso}', 'Backend\PermisosController@edit')->name('permisos.edit');
Route::patch('backend/permisos/update/{permiso}', 'Backend\PermisosController@update');
Route::get('backend/permisos/destroy/{permiso}', 'Backend\PermisosController@destroy')->name('permisos.destroy');
Route::get('backend/permisos/borrar/{permiso}', 'Backend\PermisosController@delete')->name('permisos.delete');
Route::get('backend/permisos/{rol}/detach/{permiso}', 'Backend\PermisosController@detach')->name('permisos.detach');
Route::get('backend/permisos/usuario/{account}/revoque/{permiso}', 'Backend\PermisosController@revocarPermiso')
    ->name('permisos.revoque');
Route::view('backend/permisos/accounts', 'backend.permisos.accounts')->name('permisos.accounts');

/** Profile */
Route::view('backend/profile/validardocs', 'backend.profiles.listainactivos')->name('profile.validardocs');
Route::get('backend/profile/inactivosdata', 'Backend\ProfilesController@inactivosdata')->name('profile.inactivosdata');
Route::get('backend/profile/{socio}', 'Backend\ProfilesController@profile')->name('profile.home');
Route::get('backend/profilesocio/{socio}', 'Backend\ProfilesController@profile')->name('profile.socio');
Route::post('backend/profile/avatar', 'Backend\ProfilesController@updateAvatar')->name('profile.changeavatar');
Route::get('backend/profile/tushijos/{socio}', 'Backend\ProfilesController@tusHijos')->name('profile.tushijos');
Route::get('backend/profile/leer/info/{socio}', 'Backend\ProfilesController@leerInfo')->name('profile.info');
Route::post('backend/profile/update/info/{socio}', 'Backend\ProfilesController@updateInfo');

/** Socios */
Route::get('backend/socios', 'Backend\SociosController@index')->name('socios.list');
Route::view('backend/socios/importcsv', 'backend.socios.importcsvfile');
Route::post('backend/socios/altamasiva', 'Backend\SociosController@altamasiva');
Route::get('backend/socios/sociosdata', 'Backend\SociosController@sociosdata')->name('socios.sociosdata');
Route::get('backend/socios/inactivosdata', 'Backend\SociosController@inactivosdata')->name('socios.inactivosdata');
Route::get('backend/socios/ver/{socio}', 'Backend\SociosController@view')->name('socios.ver');
Route::get('backend/socios/ver/firma/{socio}', 'Backend\SociosController@viewsignature')->name('socios.firma');
Route::get('backend/socios/ver/recibo/{socio}', 'Backend\SociosController@viewrecibo')->name('socios.recibo');
Route::get('backend/socios/ver/profile/{socio}', 'Backend\SociosController@viewprofile');
Route::get('backend/socios/borrar/{socio}', 'Backend\SociosController@delete');
Route::get('backend/socios/importarfirma/{socio}', 'Backend\SociosController@importarFirma')
    ->name('socios.importarfirma');
Route::get('backend/socios/gestionardocprofile/{socio}', 'Backend\SociosController@importarFirma')
    ->name('socios.gestionardocprofile');
Route::get('backend/socios/validarrecibo/{socio}', 'Backend\SociosController@validarRecibo')
    ->name('socios.validarrecibo');
Route::get('backend/socios/confirmarrecibo/{socio}', 'Backend\SociosController@confirmarRecibo')
    ->name('socios.confirmarrecibo');
Route::get('backend/socios/confirmarfirma/{socio}', 'Backend\SociosController@confirmarFirma')
    ->name('socios.confirmarfirma');
Route::get('backend/socios/rechazarrecibo/{socio}', 'Backend\SociosController@rechazarRecibo')
    ->name('socios.rechazarrecibo');
Route::get('backend/socios/rechazarfirma/{socio}', 'Backend\SociosController@rechazarFirma')
    ->name('socios.rechazarfirma');
Route::get('backend/socios/validarfirma/{socio}', 'Backend\SociosController@validarFirma')->name('socios.validarfirma');
Route::get('backend/socios/importarrecibo/{socio}', 'Backend\SociosController@importarRecibo')
    ->name('socios.importarrecibo');
Route::get('backend/socios/gestionarrecprofile/{socio}', 'Backend\SociosController@importarRecibo')
    ->name('socios.gestionarrecprofile');
Route::get('backend/socios/gestionardocs', 'Backend\SociosController@gestiondocumentos')->name('socios.gestionardocs');
Route::post('backend/socios/gestionardoc/adhesion/{socio}', 'Backend\SociosController@gestionaradhesion');
Route::post('backend/socios/gestionardocprofile/adhesion/{socio}', 'Backend\SociosController@gestionaradhesion');
Route::post('backend/socios/gestionardoc/justificante/{socio}', 'Backend\SociosController@gestionarjustpago');
Route::post('backend/socios/gestionardocprofile/justificante/{socio}', 'Backend\SociosController@gestionarjustpago');
Route::get('backend/socios/create', 'Backend\SociosController@create');
Route::post('backend/socios/nuevosocio', 'Backend\SociosController@store');
Route::get('backend/socios/edit/{socio}', 'Backend\SociosController@edit');
Route::patch('backend/socios/{socio}', 'Backend\SociosController@update');
Route::get('backend/socios/bajas', 'Backend\SociosController@listabajas')->name('socios.listabajas');
Route::get('backend/socios/bajas/restore/{socio}', 'Backend\SociosController@restaurar');
Route::get('backend/socios/bajas/forcedelete/{socio}', 'Backend\SociosController@bajadefinitiva');
Route::get('backend/socios/bajas/verhijos/{socio}', 'Backend\AlumnosController@listabajas');
Route::get('backend/socios/showchangepassword', 'Backend\SociosController@showchangepassword')->middleware('auth');
Route::post('backend/socios/changepassword', 'Backend\SociosController@changepassword')->middleware('auth');
Route::get('backend/socios/verdata/{socio}', 'Backend\SociosController@verdata')->name('socios.verdata');
Route::patch('backend/socios/changedata/{socio}', 'Backend\SociosController@changedata')->name('socios.changedata');
Route::get('backend/socios/verificardomiciliaciones', 'Backend\SociosController@verificarDomiciliaciones')
    ->name('socios.verificardomiciliaciones');
Route::get('backend/socios/domiciliacionesdata', 'Backend\SociosController@domiciliacionesData')
    ->name('socios.domiciliacionesdata');
Route::get('socios/backend/validardomiciliacion/{socio}', 'Backend\SociosController@validarDomiciliacion')
    ->name('socios.validardomiciliacion');

/** Alumnos */
Route::get('backend/alumnos/create/socio/{socio}', 'Backend\AlumnosController@create')->name('alumnos.socio');
Route::post('backend/alumnos/nuevoalumno', 'Backend\AlumnosController@store');
Route::get('backend/alumnos/ver/{alumno}', 'Backend\AlumnosController@view')->name('alumnos.ver');
Route::get('backend/alumnos/edit/{alumno}', 'Backend\AlumnosController@edit');
Route::patch('backend/alumnos/{alumno}', 'Backend\AlumnosController@update');
Route::get('backend/alumnos/borrar/{alumno}', 'Backend\AlumnosController@delete');
Route::get('backend/alumnos/bajas/{socio}', 'Backend\AlumnosController@gestionbajas');
Route::get('backend/alumnos/bajas/restore/{alumno}', 'Backend\AlumnosController@restaurar');
Route::get('backend/alumnos/bajas/forcedelete/{alumno}', 'Backend\AlumnosController@bajadefinitiva');

/** Actividades */
Route::get('backend/actividades/gestion', 'Backend\ActividadesController@index')->name('actividades.gestion');
Route::view('backend/actividades/publishactivity', 'backend.actividades.publishactivity')
    ->name('actividades.publishactivity');
Route::view('backend/actividades/cancelactivity', 'backend.actividades.cancelactivity')
    ->name('actividades.cancelactivity');
Route::get('backend/actividades/nopublicadasdata', 'Backend\ActividadesController@noPublicadasData')
    ->name('actividades.nopublicadasdata');
Route::get('backend/actividades/publicar/{actividad}', 'Backend\ActividadesController@publicarActividad')
    ->name('actividades.publicar');
Route::get('backend/actividades/publicadasdata', 'Backend\ActividadesController@publicadasData')
    ->name('actividades.publicadasdata');
Route::get('backend/actividades/cancelar/{actividad}', 'Backend\ActividadesController@cancelarActividad')
    ->name('actividades.cancelar');
Route::get('backend/actividades/create', 'Backend\ActividadesController@create');
Route::post('backend/actividades/nuevaactividad', 'Backend\ActividadesController@store');
Route::get('backend/actividades/actividadesdata', 'Backend\ActividadesController@actividadesdata')
    ->name('actividades.actividadesdata');
Route::get('backend/actividades/ver/{actividad}', 'Backend\ActividadesController@view')->name('actividades.ver');
Route::get('backend/actividades/edit/{actividad}', 'Backend\ActividadesController@edit')->name('actividades.edit');
Route::patch('backend/actividades/{actividad}', 'Backend\ActividadesController@update');
Route::get('backend/actividades/borrar/{actividad}', 'Backend\ActividadesController@forcedelete')
    ->name('actividades.borrar');
Route::get('backend/actividades/ver/asignaciones/{actividad}', 'Backend\ActividadesController@verAsignaciones')
    ->name('actividades.asignaciones');
Route::get('backend/actividades/asignar/{actividad}', 'Backend\ActividadesController@asignarActividad')
    ->name('actividades.asignaractividad');
Route::get('backend/actividades/desasignar/{actividad}', 'Backend\ActividadesController@desAsignarActividad')
    ->name('actividades.desasignaractividad');
Route::get('backend/actividades/asignar/{actividad}/{alumno}', 'Backend\ActividadesController@asignar')
    ->name('actividades.asignar');
Route::get('backend/actividades/desasignar/{alumno}/{actividad}', 'Backend\AlumnosController@desasignaActividad')
    ->name('actividades.desasignar');
Route::get('backend/actividades/asignacionesdata/{actividad}', 'Backend\ActividadesController@asignacionesData')
    ->name('actividades.asignacionesdata');
Route::get('backend/actividades/autorizar/{alumno}/{actividad}', 'Backend\ActividadesController@autorizarActividad')
    ->name('actividades.autorizaractividad');
Route::get(
    'backend/actividades/desautorizar/{alumno}/{actividad}',
    'Backend\ActividadesController@desautorizarActividad'
)->name('actividades.desautorizaractividad');

/** Actas */
Route::view('backend/actas', 'backend.actas.index')->name('actas.list');
Route::get('backend/actas/actasdata', 'Backend\ActasController@actasData')->name('actas.actasdata');
Route::get('backend/actas/elaborar/{reunion}', 'Backend\ActasController@elaborarActa')->name('actas.elaborar');
Route::get('backend/actas/ver/{reunion}', 'Backend\ActasController@verActa')->name('actas.ver');
Route::get('backend/actas/listarpendientes', 'Backend\ActasController@listarActasPendientes')
->name('actas.listarpendientes');
Route::get('backend/actas/importar/{acta}', 'Backend\ActasController@importarActa')
->name('actas.importarfirmada');
Route::post('backend/actas/registrar', 'Backend\ActasController@registrarActaFirmada')
->name('actas.registrarfirmada');
Route::get('backend/actas/pendientes', 'Backend\ActasController@pendientesData')->name('actas.pendientesdata');

/** Acuerdos */
Route::get('backend/acuerdos/temas/{reunion}', 'Backend\AcuerdosController@nuevoAcuerdoTema')
    ->name('acuerdos.acuerdostemas');
Route::post('backend/acuerdos/nuevo/{tema}', 'Backend\AcuerdosController@nuevoAcuerdo')->name('acuerdos.nuevo');
Route::get('backend/acuerdos/{reunion}', 'Backend\AcuerdosController@index')->name('acuerdos.list');
Route::get('backend/acuerdos/acuerdosdata/{reunion}', 'Backend\AcuerdosController@acuerdosData')
    ->name('acuerdos.acuerdosdata');
Route::get('backend/acuerdos/acuerdo/tema/{tema}', 'Backend\AcuerdosController@acuerdo')
    ->name('acuerdos.acuerdo');
Route::patch('backend/acuerdos/update/{acuerdo}', 'Backend\AcuerdosController@updateAcuerdo')->name('acuerdos.update');

/** Reuniones */
Route::get('backend/reuniones/gestion', 'Backend\ReunionesController@index')->name('reuniones.gestion');
Route::get('backend/reuniones/reunionesdata', 'Backend\ReunionesController@reunionesData')
    ->name('reuniones.reunionesdata');
Route::get('backend/reuniones/create', 'Backend\ReunionesController@create')->name('reuniones.create');
Route::post('backend/reuniones/nuevareunion', 'Backend\ReunionesController@store')->name('reuniones.nueva');
Route::get('backend/reuniones/ver/{reunion}', 'Backend\ReunionesController@view')->name('reuniones.ver');
Route::view('backend/reuniones/cancelmeeting', 'backend.reuniones.cancelmeeting')
    ->name('reuniones.cancelmeeting');
Route::get('backend/reuniones/edit/{reunion}', 'Backend\ReunionesController@edit')->name('reuniones.edit');
Route::patch('backend/reuniones/{reunion}', 'Backend\ReunionesController@update');
Route::get('backend/reuniones/borrar/{reunion}', 'Backend\ReunionesController@forcedelete')
    ->name('reuniones.borrar');
Route::view('backend/reuniones/arrangemeeting', 'backend.reuniones.arrangemeeting')
    ->name('reuniones.arrangemeeting');
Route::get('backend/reuniones/noconvocadasdata', 'Backend\ReunionesController@noConvocadasData')
    ->name('reuniones.noconvocadasdata');
Route::get('backend/reuniones/convocadasdata', 'Backend\ReunionesController@convocadasData')
    ->name('reuniones.convocadasdata');
Route::get('backend/reuniones/convocar/{reunion}', 'Backend\ReunionesController@convocarReunion')
    ->name('reuniones.convocar');
Route::get('backend/reuniones/cancelar/{reunion}', 'Backend\ReunionesController@cancelarReunion')
    ->name('reuniones.cancelar');

/** Temas */
Route::get('backend/temas/create/reunion/{reunion}', 'Backend\TemasController@create')->name('temas.reunion');
Route::post('backend/temas/nuevo', 'Backend\TemasController@store')->name('temas.nuevo');
Route::get('backend/temas/ver/{tema}', 'Backend\TemasController@ver')->name('temas.ver');
Route::get('backend/temas/editar/{tema}', 'Backend\TemasController@editar')->name('temas.editar');
Route::patch('backend/temas/{tema}', 'Backend\TemasController@update');
Route::get('backend/temas/borrar/{tema}', 'Backend\TemasController@delete')->name('temas.borrar');
Route::get('backend/temas/ver/reunion/{reunion}', 'Backend\TemasController@verTemasReunion')->name('temas.reunionver');

/** Asistentes */
Route::get('backend/asistentes/create/reunion/{reunion}', 'Backend\AsistentesController@create')
    ->name('asistentes.reunion');
Route::post('backend/asitentes/nuevo', 'Backend\AsistentesController@store')->name('asistentes.nuevo');
Route::get('backend/asistentes/asistentesdata/{reunion}', 'Backend\AsistentesController@asistentesData')
    ->name('asistentes.asistentesdata');
Route::get('backend/asistentes/borrar/{asistente}/reunion/{reunion}', 'Backend\AsistentesController@delete')
    ->name('asistentes.borrar');
Route::get('backend/asistentes/ver/reunion/{reunion}', 'Backend\AsistentesController@verAsistentesReunion')
    ->name('asistentes.reunionver');

/** Periodos */
Route::view('backend/periodos/gestion', 'backend.periodos.index')->name('periodos.gestion');
Route::get('backend/periodos/periodosdata', 'Backend\PeriodosController@periodosData')
->name('periodos.periodosdata');
Route::get('backend/periodos/cerrar/{periodo}', 'Backend\PeriodosController@cerrar')->name('periodos.cerrar');
Route::get('backend/periodos/abrir/{periodo}', 'Backend\PeriodosController@abrir')->name('periodos.abrir');
Route::post('backend/periodos/nuevo', 'Backend\PeriodosController@store')->name('periodos.nuevo');
Route::get('backend/periodos/ver/{periodo}', 'Backend\PeriodosController@ver')->name('periodos.ver');

/** Cuentas */
Route::view('backend/cuentas', 'backend.cuentas.index')->name('cuentas.list');
Route::get('backend/cuentas/cuentasdata', 'Backend\CuentasController@cuentasData')->name('cuentas.cuentasdata');
Route::get('backend/cuentas/create', 'Backend\CuentasController@create')->name('cuentas.createitem');
Route::post('backend/cuentas/nuevoitem', 'Backend\CuentasController@nuevoItem')->name('cuentas.nuevoitem');
Route::get('backend/cuentas/ver/{movimiento}', 'Backend\CuentasController@ver')->name('cuentas.ver');
Route::get('backend/cuentas/editar/{movimiento}', 'Backend\CuentasController@editar')->name('cuentas.editar');
Route::patch('backend/cuentas/{movimiento}', 'Backend\CuentasController@update')->name('cuentas.update');
Route::get('backend/cuentas/verfactura/{factura}', 'Backend\FacturasController@verFactura')->name('cuentas.verfactura');

/** Facturas */
Route::get('backend/facturas/gestion', 'Backend\FacturasController@index')->name('facturas.gestion');
Route::get('backend/facturas/facturasdata', 'Backend\FacturasController@facturasData')->name('facturas.facturasdata');
Route::get('backend/facturas/create', 'Backend\FacturasController@create')->name('facturas.create');
Route::post('backend/facturas/nuevafactura', 'Backend\FacturasController@nuevaFactura')->name('facturas.nuevafactura');
Route::get('backend/facturas/{factura}', 'Backend\FacturasController@importarFactura')
->name('facturas.importarfactura');
Route::post('backend/facturas/importar', 'Backend\FacturasController@registrarDocumento')
->name('facturas.documento');
Route::get('backend/facturas/ver/{factura}', 'Backend\FacturasController@ver')->name('facturas.ver');
Route::get('backend/facturas/borrar/{factura}', 'Backend\FacturasController@borrar')->name('facturas.borrar');
Route::get('backend/facturas/eliminar/{entrada}/{factura}', 'Backend\FacturasController@eliminar')
->name('facturas.eliminar');
Route::get('backend/facturas/editar/{factura}', 'Backend\FacturasController@editar')->name('facturas.editar');
Route::patch('backend/facturas/actualizar/{factura}', 'Backend\FacturasController@update')->name('facturas.update');

/** Recibos */
Route::view('backend/recibos', 'backend.recibos.index')->name('recibos.list');
Route::get('backend/recibos/recibosdata/{usuario}', 'Backend\RecibosController@recibosData')
->name('recibos.recibosdata');
Route::get('backend/recibos/ver/{recibo}', 'Backend\RecibosController@ver')->name('recibos.ver');

/**
 *  RUTA DE LA SELECCIÓN DE IDIOMA
 *  ------------------------------
 */
/* Idioma */
Route::get(
    'backend/profile/lang/{lang}',
    function ($lang) {
        session(['lang' => $lang]);
        return Redirect::back();
    }
)->where(
    [
        'lang' => 'en|es'
    ]
);
