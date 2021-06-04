<?php

namespace App\Mail;

use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovoPedidoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $pedido_id;
    public $pastel;
    public $data_criacao;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pedido $pedido, string $pastel)
    {
        $this->nome = $pedido->cliente->nome;
        $this->pedido_id = $pedido->id;
        $this->pastel = $pastel;
        $this->data_criacao = $pedido->created_at;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.novo-pedido')->subject('Novo Pedido Realizado');
    }
}
