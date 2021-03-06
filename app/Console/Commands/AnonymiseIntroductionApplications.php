<?php

    namespace App\Console\Commands;

    use App\IntroApplication;
    use App\Introduction;
    use App\IntroSupervisorApplication;
    use Carbon\Carbon;
    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\Log;

    /**
     * Class AnonymiseIntroductionApplications
     *
     * @package App\Console\Commands
     */
    class AnonymiseIntroductionApplications extends Command {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'intro:anonymise';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Haal onherroepelijk alle persoonsgegevens uit de aanmeldingen van introducties weg. Dit gebeurt alleen voor introducties waarbij de uiterlijke aanmelddatum 2 maanden geleden is. Hierdoor worden deze gegevens onbruikbaar.';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct() {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle() {
            Log::debug('Controleren of er een introductie is waarvan de uiterlijke aanmelddatum meer dan 2 maanden geleden is...');
            $introductions = Introduction::where('signup_close', '<', Carbon::today()->subMonths(2))->get();
            Log::debug('Dit heb ik gevonden', [$introductions]);
            if ($introductions->isNotEmpty()) {
                /** @var Introduction $introduction */
                foreach ($introductions as $introduction) {
                    $applications = $introduction->applications->where('type', '!=', IntroApplication::TYPE_ANONYMISED);
                    $applications->each(function (IntroApplication $application) {
                        Log::debug("Anonimiseren van aanmelding", ['id' => $application->id]);
                        $application->anonymise();
                    });
                    $applications = $introduction->supervisorApplications->where('type', '!=', IntroSupervisorApplication::TYPE_ANONYMISED);
                    $applications->each(function (IntroSupervisorApplication $application) {
                        Log::debug("Anonimiseren van ouder-aanmelding", ['id' => $application->id]);
                        $application->anonymise();
                    });
                    Log::debug("Aanmeldingen geanonimiseerd", ['count' => $applications->count()]);
                    $this->info("Aanmeldingen geanonimiseerd: " . $applications->count());
                    Log::info("Aanmeldingen zijn geanonimiseerd", ['intro' => $introduction]);
                }
            } else {
                $this->info("Geen introducties gevonden waarbij de uiterlijke aanmelddatum < " . Carbon::today()->subMonths(2));
            }
        }
    }
