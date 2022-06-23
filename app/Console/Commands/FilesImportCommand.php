<?php

namespace App\Console\Commands;

use App\Imports\BenefitsImport;
use App\Imports\BlcRelationImport;
use App\Imports\BusinessImport;
use App\Imports\CheckListProblemImport;
use App\Imports\ClassificationImport;
use App\Imports\ComfortImport;
use App\Imports\EventImport;
use App\Imports\GymComfortImport;
use App\Imports\GymCourtImport;
use App\Imports\GymImport;
use App\Imports\GymLeaseImport;
use App\Imports\GymSubscriptionImport;
use App\Imports\GymWorkoutImport;
use App\Imports\LeaseImport;
use App\Imports\PartnersImport;
use App\Imports\SubscriptionClassificationImport;
use App\Imports\SubscriptionImport;
use App\Imports\TennisCourtImport;
use App\Imports\WorkoutImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class FilesImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        Excel::import(new ClassificationImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'classificacoes.xlsx');
        Excel::import(new GymImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'unidades.xlsx');
        Excel::import(new BusinessImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'business.xlsx');
        Excel::import(new SubscriptionImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'assinaturas.xlsx');
        Excel::import(new GymSubscriptionImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'unidades_x_assinaturas.xlsx');
        Excel::import(new WorkoutImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'aulas.xlsx');
        Excel::import(new GymWorkoutImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'unidades_x_aulas.xlsx');
        Excel::import(new GymImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'unidades.xlsx');
        Excel::import(new ComfortImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'comodidades.xlsx');
        Excel::import(new TennisCourtImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'quadras.xlsx');
        Excel::import(new GymComfortImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'comodidades_x_unidades.xlsx');
        Excel::import(new GymCourtImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'unidade_x_quadras.xlsx');
        Excel::import(new PartnersImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'parceiros.xlsx');
        Excel::import(new LeaseImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'locacoes.xlsx');
        Excel::import(new GymLeaseImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'locacoes_x_unidades.xlsx');
        Excel::import(new SubscriptionClassificationImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'assinaturas_x_classificacoes.xlsx');
        Excel::import(new BenefitsImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'beneficios_x_produtos.xlsx');
        Excel::import(new EventImport, public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'eventos.xlsx');

    }
}
