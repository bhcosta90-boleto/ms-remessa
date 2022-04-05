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
    public function __construct(
        private ConsumeSupport $consumeSupport,
        private SynchronizeTableSupport $synchronizeTableSupport
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $rules = [
            'uuid' => 'required',
            'id' => 'required',
            'cliente_nome' => 'required',
            'cliente_documento' => 'required',
            'valor' => 'required',
            'operacao' => 'nullable',
            'banco_id' => 'required',
            'vencimento' => 'required',
            'numero_banco' => 'required',
        ];

        $this->consumeSupport->function("table.cobrancas", 'app.ms_cobrancas.table.cobrancas.*', $rules, function ($data) {
            $data['operacao'] = $data['operacao'] ?? '02';
            $this->synchronizeTableSupport->sync('cobrancas', 'cobranca_id', $data['id'], $data);
        });
    }
}
