    <?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Models\backend\Entidad;
    use Livewire\WithPagination;

    class EntidadController extends Controller
    {
        use WithPagination;
        // public function mostrarEntidades()
        // {
        //     $entidades = Entidad::All();

        //     return view('entidades', ['entidades' => $entidades]);
        // }

        public function __invoke(Request $request): \Illuminate\Contracts\View\View
        {
            $entidades = Entidad::paginate(10);
            $title = $request->query('title');

            return view('live-entidades', compact('entidades', 'title'));
        }
    }
