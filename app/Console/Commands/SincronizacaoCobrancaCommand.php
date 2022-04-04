<?php

namespace App\Console\Commands;

use App\Jobs\CobrancaSincronizarJob;
use App\Services\CobrancaService;
use App\Services\Traits\ValidateTrait;
use Bschmitt\Amqp\Facades\Amqp;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PJBank\Package\Support\ConsumeSupport;
use PJBank\Package\Support\SynchronizeTableSupport;

class SincronizacaoCobrancaCommand extends Command
{
    use ValidateTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cobranca:sincronizar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronização das cobranças';

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
     * @return mixed
     */
    public function handle(ConsumeSupport $consumeSupport)
    {
        $consumeSupport->job('app.ms_cobrancas.table.cobrancas.*', CobrancaSincronizarJob::class);
    }
}
