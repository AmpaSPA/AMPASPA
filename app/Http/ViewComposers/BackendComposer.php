<?php

/**
 * Clase que contiene todas las variables comunes a todas las vistas de la parte de Backend de la aplicación
 */

namespace App\Http\ViewComposers;

use App\Repositories\SocioRepository;
use Carbon\Carbon;
use Illuminate\View\View;

class BackendComposer
{
    protected $socios;

    /**
     * BackendComposer constructor.
     * @param SocioRepository $socios
     */
    public function __construct(SocioRepository $socios)
    {
        $this->socios = $socios;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $anioant = 0;
        $anio = 0;
        $idioma = '';
        $perfilasignado = '';

        switch (config('app.locale')) {
            case 'es':
                $idioma = 'Castellano';
                break;
            case 'en':
                $idioma = 'English';
                break;
        }

        if (Carbon::now()->month <=6) {
            $anioant = Carbon::now()->year - 1;
            $anio = Carbon::now()->year;
        } else {
            $anioant = Carbon::now()->year;
            $anio = Carbon::now()->year + 1;
        }

        $view->with('idioma', $idioma)->with('numsocios', $this->socios->totalsocios())->with('anioant', $anioant)->with('anio', $anio)->with('mes', Carbon::now()->month)->with('docs_pendientes_importar', $this->socios->obtenerDocsPendientesImportar()->count())->with('verificar_documentos', $this->socios->verificarDocumentos()->count());
    }
}
