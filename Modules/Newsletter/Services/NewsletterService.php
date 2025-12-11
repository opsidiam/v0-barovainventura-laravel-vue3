<?php

namespace Modules\Newsletter\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Modules\Newsletter\Models\Newsletter;

class NewsletterService
{
    public function handle() {}


    public function store()
    {
        try {
            $newsletter = Newsletter::create([
                'subject' => request('subject'),
                'message' => request('content'),
                'sending_done' => false
            ]);

            if ($newsletter) {
                return true;
            }

            return false;

        } catch (Exception $e) {
            Log::error('Chyba pri vytváraní newsletteru: ' . $e->getMessage());

            return false;
        }
    }

    public function showNewsletter($id)
    {
        return Newsletter::find($id);
    }

    public function newsletterUser()
    {
        $data['user']['name'] = '';
        $data['user']['surname'] = '';
        $data['user']['email_info'] = '';
        return $data;
    }

    public function allowSendNewsletter($id)
    {
        $newsletter = Newsletter::find($id);
        abort_unless($newsletter,404);
        $newsletter->ready_to_send = true;
        $newsletter->save();
        return true;
    }


    public function destroy($id)
    {
        $newsletter = Newsletter::find($id);
        return $newsletter->delete();
    }
}
