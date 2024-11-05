<?php

require_once 'models/Evaluation.php';
require_once 'models/GameSchedules.php';
require_once 'core/Helper.php';
require_once 'enums/EvaluationStatus.php';
require_once 'models/User.php';

class EvaluationController
{
    private $evaluation;
    private $gameScheds;
    private $user;

    public function __construct()
    {
        $this->evaluation = new Evaluation();
        $this->gameScheds = new GameSchedules();
        $this->user = new User();
    }

    // /sms/athlete/submit-evaluation - Index page
    public function submit($param)
    {
        $gameId = $param['game-id'];

        // Scan directory for files
        $directory = 'assets/downloadable';
        $files = array_diff(scandir($directory), ['.', '..']);

        $gameSched = $this->gameScheds->findById($gameId);
        $eval = $this->evaluation->findByGameIdAndAthleteId($gameId, $_SESSION['user_id']);

        if (!$eval) {
            Helper::redirect('404-not-found');
        }

        if ($eval['deleted_at'] !== null) {
            Helper::redirect('404-not-found');
        }

        // Deadline
        $scheduleDate = new DateTime($gameSched['schedule']);
        $deadlineDate = (clone $scheduleDate)->modify('-7 days');

        // print_r([$scheduleDate, $deadlineDate]);die();
        if ($deadlineDate < new DateTime()) {
            Helper::redirect('404-not-found');
        }

        include 'views/athlete/submit-evaluation.php';
    }

    public function submit_form($request)
    {
        $userId = $_SESSION['user_id'];
        $_GET['game-id'] = $request['game_schedules_id'];
        $gameId = $request['game_schedules_id'];

        $directory = 'assets/downloadable';
        $files = array_diff(scandir($directory), array('.', '..'));

        // Eligibility form
        $eligi_fileName = md5(uniqid(date('YmdHis'), true));
        $eligi_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/evaluation/$userId/",
            'filename' => $eligi_fileName,
            'file' => $_FILES['eligibility_form'],
            'allowed_types' => ['pdf', 'jpg', 'png', 'docx'],
            'max_size' => 19000
        ]);

        // Try-out form
        $tryout_fileName = md5(uniqid(date('YmdHis'), true));
        $tryout_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/evaluation/$userId/",
            'filename' => $tryout_fileName,
            'file' => $_FILES['tryout_form'],
            'allowed_types' => ['pdf', 'jpg', 'png', 'docx'],
            'max_size' => 19000
        ]);

        // Medical certificate
        $med_fileName = md5(uniqid(date('YmdHis'), true));
        $med_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/evaluation/$userId/",
            'filename' => $med_fileName,
            'file' => $_FILES['med_cert'],
            'allowed_types' => ['pdf', 'jpg', 'png', 'docx'],
            'max_size' => 19000
        ]);

        // Certificate of registration
        $cor_fileName = md5(uniqid(date('YmdHis'), true));
        $cor_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/evaluation/$userId/",
            'filename' => $cor_fileName,
            'file' => $_FILES['cor'],
            'allowed_types' => ['pdf', 'jpg', 'png', 'docx'],
            'max_size' => 19000
        ]);

        // Grades
        $grades_fileName = md5(uniqid(date('YmdHis'), true));
        $grades_result = Helper::fileUpload([
            'target_dir' => "assets/uploads/evaluation/$userId/",
            'filename' => $grades_fileName,
            'file' => $_FILES['grades'],
            'allowed_types' => ['pdf', 'jpg', 'png', 'docx'],
            'max_size' => 19000
        ]);

        $data = [
            'contract_date' => $request['contract_date'],
            'game_schedules_id' => $request['game_schedules_id'],
            'athlete_id' => $request['athlete_id'],
            'eligibility_form' => $eligi_result['file'],
            'tryout_form' => $tryout_result['file'],
            'med_cert' => $med_result['file'],
            'cor' => $cor_result['file'],
            'grades' => $grades_result['file'],
            'status' => EvaluationStatus::SUBMITTED
        ];

        $this->evaluation->submit_form($data);

        $eval = $this->evaluation->findByGameIdAndAthleteId($gameId, $_SESSION['user_id']);
        $isSubmited = false;
        if ($eval['eligibility_form'] !== null) {
            $isSubmited = true;
        }

        return include 'views/athlete/submit-evaluation.php';
    }

    // Coordinator
    public function show($params)
    {
        // header('Content-Type: application/json');
        $gameId = $params['game-id'];

        $evaluations = $this->evaluation->findAllByGameIdJoinUsers($gameId, true);
        $gameSched = $this->gameScheds->findById($gameId);

        // echo json_encode($evaluations);

        return include 'views/coordinator/evaluations.php';
    }

    public function approve_disapprove($request)
    {
        header('Content-Type: application/json');

        // get coordinator name
        $user = $this->user->getUser($_SESSION['user_id']);

        $note = Helper::sanitize($request['msg']);

        $status = ($request['action'] === 'approve')
            ? EvaluationStatus::APPROVED
            : EvaluationStatus::DISAPPROVED;

        $response = $this->evaluation->approve_disapprove($request['id'], $status);
        
        $athlete = $this->evaluation->findAthleteById($request['id']);

        $template = $status === EvaluationStatus::APPROVED
            ? file_get_contents('template/evaluation/approve.html')
            : file_get_contents('template/evaluation/disapprove.html');

        $body = str_replace('[Athlete_Name]', $athlete['full_name'], $template);

        if ($status === EvaluationStatus::DISAPPROVED) {
            $body = str_replace('[Note]', "<strong>". $user['full_name']."</strong>: $note", $body);
        }
        
        $data = [
            'email' => $athlete['email'],
            'name' => $athlete['full_name'],
            'subject' => 'Evaluation Result',
            'body' => $body,
        ];

        Helper::sendMail($data);

        echo json_encode([
            'success' => $response
        ]);
    }
}