<?php

namespace App\Jobs;

use App\Services\CobrancaService;
use Illuminate\Support\Facades\Log;
use PJBank\Package\Support\SynchronizeTableSupport;

class CobrancaSincronizarJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $data)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->getSynchronizeTableSupport()->sync('cobrancas', 'cobranca_id', $this->data['id'], [
            'uuid' => $this->data['uuid'],
            'cobranca_id' => $this->data['id'],
            'cliente_nome' => $this->data['cliente_nome'],
            'cliente_documento' => $this->data['cliente_documento'] ?? null,
            'valor' => $this->data['valor'],
            'operacao' => $this->data['operacao'] ?? '02',
            'banco_id' => $this->data['banco_id'],
            'vencimento' => $this->data['vencimento'],
            'numero_banco' => $this->data['numero_banco'],
        ]);
    }

    public function getSynchronizeTableSupport(): SynchronizeTableSupport
    {
        return app(SynchronizeTableSupport::class);
    }
}
