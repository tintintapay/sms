<?php

require_once 'core/Model.php';

class AthletesRating extends Model
{
    public function fetchByAthlete($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM athletes_ratings WHERE athlete_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchByGameIdAthleteId($gameId, $athleteId)
    {
        $stmt = $this->db->prepare("SELECT * FROM athletes_ratings WHERE game_id = ? AND athlete_id = ?");
        $stmt->bind_param("ii", $gameId, $athleteId);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO athletes_ratings (created_user, athlete_id, game_id, teamwork, sportsmanship, technical_skills, adaptability, game_sense, remarks)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "iiiiiiiis",
            $data['created_user'],
            $data['athlete_id'],
            $data['game_id'],
            $data['teamwork'],
            $data['sportsmanship'],
            $data['technical_skills'],
            $data['adaptability'],
            $data['game_sense'],
            $data['remarks']
        );

        if (!$stmt->execute()) {
            return null;
        }

        return $this->db->insert_id;
    }
    
    public function update($data)
    {
        $stmt = $this->db->prepare("
            UPDATE athletes_ratings SET teamwork = ?, sportsmanship = ?, technical_skills = ?, adaptability = ?, game_sense = ?, remarks = ?
            WHERE game_id = ? AND athlete_id = ?
        ");

        $stmt->bind_param(
            "iiiiisii",
            $data['teamwork'],
            $data['sportsmanship'],
            $data['technical_skills'],
            $data['adaptability'],
            $data['game_sense'],
            $data['remarks'],
            $data['game_id'],
            $data['athlete_id'],
        );

        return $stmt->execute();
    }
}