<?php

require_once 'models/Announcement.php';
require_once 'requests/AnnouncementRequest.php';
require_once 'core/Helper.php';

class AnnouncementController
{
    private $announcement;

    public function __construct()
    {
        $this->announcement = new Announcement();
    }

    public function index()
    {
        $announcements = $this->announcement->fetchAll();

        $_SESSION['menu'] = 'announcement';
        return include 'views/coordinator/announcements.php';
    }

    public function create()
    {
        return include 'views/coordinator/announcements-create.php';
    }

    public function store($request)
    {
        $validated = new AnnouncementRequest();
        $flash = $validated->validate($request);

        $title = Helper::sanitize($request['title']);
        $description = Helper::sanitize($request['description']);

        if (!$flash['isValid']) {
            return include 'views/coordinator/announcements-create.php';
        }

        $data = [
            'title'=> $title,
            'description'=> $description,
            'created_user' => $_SESSION['user_id']
        ];

        $response = $this->announcement->insert($data);

        if ($response) {
            Helper::redirect('announcements');
        }
    }

    public function show($params)
    {
        $request = $this->announcement->findById($params['id']);

        $request['id'] = $params['id'];

        return include 'views/coordinator/announcement.php';
    }

    public function delete($request)
    {
        header('Content-Type: application/json');
        $res = $this->announcement->delete($request['id']);

        if (!$res) {
            echo json_encode(['success' => false]);
            exit();
        }

        echo json_encode(['success' => true]);
    }
}