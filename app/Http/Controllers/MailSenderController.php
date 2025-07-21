<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MailSenderRepository;

class MailSenderController extends Controller
{
    protected $MailSenderRepository;

    public function __construct(MailSenderRepository $MailSenderRepository)
    {
        $this->MailSenderRepository = $MailSenderRepository;
    }

    public function index()
    {
        return view('mail_sender.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email_file' => 'required|file|mimes:csv,xlsx',
        ]);

        $this->MailSenderRepository->processFile($request->email_file);

        return redirect()->back()->with('success', 'Mail Sent &Log saved successfully.');
    }
}
