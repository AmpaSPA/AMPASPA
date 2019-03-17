<?php

/**
 * Clase que contiene todas las variables comunes a todas las vistas de la parte de Backend de la aplicación
 */

namespace App\Http\ViewComposers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Repositories\SocioRepository;
use App\Repositories\ProceedingRepository;
use App\Repositories\PeriodoRepository;

class BackendComposer
{
    protected $socios;
    protected $actas;
    protected $periodos;

    /**
     * BackendComposer constructor.
     * @param SocioRepository $socios
     */
    public function __construct(SocioRepository $socios, ProceedingRepository $actas, PeriodoRepository $periodos)
    {
        $this->socios = $socios;
        $this->actas = $actas;
        $this->periodos = $periodos;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $idioma = '';

        switch (config('app.locale')) {
            case 'es':
                $idioma = 'Castellano';
                break;
            case 'en':
                $idioma = 'English';
                break;
        }

        $periodo = $this->periodos->buscarPeriodoActivo();

        $view->with('idioma', $idioma)
            ->with('periodo', $periodo)
            ->with('numsocios', $this->socios->totalsocios())
            ->with('numActas', $this->actas->totalActas())
            ->with('mes', Carbon::now()->month)
            ->with('docs_pendientes_importar', $this->socios->obtenerDocsPendientesImportar()->count())
            ->with('verificar_documentos', $this->socios->verificarDocumentos()->count());
    }
}
