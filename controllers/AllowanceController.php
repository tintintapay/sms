<?php

require_once 'core/Helper.php';
require_once 'models/User.php';

class AllowanceController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        return include 'views/admin/allowance.php';
    }

    public function send_allowance_notice($request)
    {
        header('Content-Type: application/json');

        $msg = Helper::sanitize($request['msg']);

        $athletes = $this->user->fetchAllApprovedAthleteWithInfo();
        $email = [];
        foreach ($athletes as $athlete) {
            $email[] = [
                'email' => $athlete['email'],
                'name' => $athlete['full_name'],
            ];
        }

        $template = file_get_contents('template/mail/allowance.html');
        $body = str_replace('[Recipient_Name]', 'Athletes', $template);
        $body = str_replace('[message_content]', $msg, $body);
        $data = [
            'email' => $email,
            'subject' => 'Allowance Available for Claim',
            'body' => $body,
        ];

        $send = Helper::sendMail($data);

        if ($send) {
            echo json_encode([
                'success' => true
            ]);
        }
    }
}