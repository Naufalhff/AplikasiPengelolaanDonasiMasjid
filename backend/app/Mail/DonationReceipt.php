<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $id_donasi;
    public $tanggal_donasi;
    public $nama_kegiatan;
    public $jumlah_donasi;
    public $nama_donatur;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_donasi, $tanggal_donasi, $nama_kegiatan, $jumlah_donasi, $nama_donatur)
    {
        $this->id_donasi = $id_donasi;
        $this->tanggal_donasi = $tanggal_donasi;
        $this->nama_kegiatan = $nama_kegiatan;
        $this->jumlah_donasi = $jumlah_donasi;
        $this->nama_donatur = $nama_donatur;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Kuitansi Donasi')
            ->view('emails.receipt')
            ->with([
                'id_donasi' => $this->id_donasi,
                'tanggal_donasi' => $this->tanggal_donasi,
                'nama_kegiatan' => $this->nama_kegiatan,
                'jumlah_donasi' => $this->jumlah_donasi,
                'nama_donatur' => $this->nama_donatur,
            ]);
    }
}
