<?php
/**
 * Clase que contiene todas las variables comunes a todas las vistas de la parte de Backend de la aplicación
 */
namespace App\Http\ViewComposers;

use App\Repositories\EntradaRepository;
use App\Repositories\PeriodoRepository;
use App\Repositories\ProceedingRepository;
use App\Repositories\SocioRepository;
use Carbon\Carbon;
use Illuminate\View\View;
use App\Repositories\FacturaRepository;

class BackendComposer
{
    protected $socios;
    protected $actas;
    protected $periodos;
    protected $entrada;
    protected $facturas;

    /**
     * BackendComposer constructor.
     * @param SocioRepository $socios
     */
    public function __construct(
        SocioRepository $socios,
        ProceedingRepository $actas,
        PeriodoRepository $periodos,
        EntradaRepository $entrada,
        FacturaRepository $facturas
    ) {
        $this->socios = $socios;
        $this->actas = $actas;
        $this->periodos = $periodos;
        $this->entrada = $entrada;
        $this->facturas = $facturas;
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

        $importes = $this->entrada->calcularImportesPeriodo($periodo->periodo);

        $view->with('idioma', $idioma)
            ->with('periodo', $periodo)
            ->with('saldoPeriodo', $importes['saldo'])
            ->with('numsocios', $this->socios->totalsocios())
            ->with('numActas', $this->actas->totalActas())
            ->with('docs_pendientes_importar', $this->socios->obtenerDocsPendientesImportar()->count())
            ->with('verificar_documentos', $this->socios->verificarDocumentos()->count())
            ->with('facturas_pendientes', $this->facturas->totalFacturasSinImportar($periodo->periodo));
    }
}
