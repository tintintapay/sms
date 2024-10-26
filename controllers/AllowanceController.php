<?php

require_once 'core/Helper.php';
require_once 'models/User.php';
require_once 'models/Allowances.php';

class AllowanceController
{
    private $user;
    private $allowance;

    public function __construct()
    {
        $this->user = new User();
        $this->allowance = new Allowances();
    }

    public function index()
    {
        $_SESSION['menu'] = 'allowance';
        return include 'views/admin/allowance.php';
    }

    public function send_allowance_notice($request)
    {
        header('Content-Type: application/json');

        $msg = Helper::sanitize($request['msg']);

        $athletes = $this->user->fetchAllApprovedAthleteWithInfo();
        $email = [];
        $insertData = [];
        foreach ($athletes as $athlete) {
            $email[] = [
                'email' => $athlete['email'],
                'name' => $athlete['full_name'],
            ];

            $insertData[] = [
                'athlete_id' => $athlete['user_id'],
                'message' => $msg,
                'created_user' => $_SESSION['user_id']
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

        // Send mail
        $send = Helper::sendMail($data);

        // Insert Allowance
        $insert = $this->allowance->insertMultiple($insertData);

        if ($send && $insert) {
            echo json_encode([
                'success' => true
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'msg'=> json_encode(['mail' => $send, 'insert' => $insert])
            ]);
        }
    }

    public function claim($request)
    {
        $data = [
            'athlete_id' => $request['id'],
            'status' => AllowanceStatus::RECEIVED
        ];

        $update = $this->allowance->updateClaim($data);

        if ($update) {
            Helper::redirect('home');
        }
    }
}