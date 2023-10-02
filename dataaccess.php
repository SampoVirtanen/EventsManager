<?php
include "datamodel.php";

class DataAccess
{
    private $connection;
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function addParticipant($participant)
    {
        try {
            $query = $this->connection->prepare(
                "INSERT INTO participants (first_name, last_name, email) VALUES (:fn, :ln, :em)"
            );
            $query->execute(array(
                ":fn" => $participant->getFirstName(),
                ":ln" => $participant->getLastName(),
                ":em" => $participant->getEmail()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }

    public function getParticipants()
    {
        $participants = [];
        try {
            $query = $this->connection->prepare(
                "SELECT * FROM participants"
            );
            $query->execute();
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
        $result = $query->fetchAll();
        foreach ($result as $i) {
            $participant = new Participant($i[1], $i[2], $i[3]);
            $participant->setID($i[0]);
            array_push($participants, $participant);
        }
        return $participants;
    }

    public function updateParticipant($participant)
    {
        try {
            $query = $this->connection->prepare(
                "UPDATE participants SET first_name = :fn, last_name = :ln, email = :em WHERE id=:id"
            );
            $query->execute(array(
                ":fn" => $participant->getFirstName(),
                ":ln" => $participant->getLastName(),
                ":em" => $participant->getEmail(),
                ":id" => $participant->getId(),
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }

    public function deleteParticipant($participant)
    {
        try {
            $query = $this->connection->prepare(
                "DELETE FROM participants WHERE id=:id"
            );
            $query->execute(array(
                ":id" => $participant->getID()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }

    public function addEventParticipants($event)
    {
        foreach ($event->getParticipants() as $participant) {
            try {
                $query = $this->connection->prepare(
                    "INSERT INTO events_participants (event_id, participant_id) VALUES (:eid, :pid)"
                );
                $query->execute(array(
                    ":eid" => $event->getID(),
                    ":pid" => $participant->getID()
                ));
            } catch (PDOException $e) {
                die("VIRHE: " . $e->getMessage());
            }
        }
    }

    public function getEventParticipants($event)
    {
        $participants = [];
        try {
            $query1 = $this->connection->prepare(
                "SELECT * FROM events_participants WHERE event_id=:eid"
            );
            $query1->execute(array(
                ":eid" => $event->getID()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
        $result1 = $query1->fetchAll();
        foreach ($result1 as $i) {
            try {
                $query2 = $this->connection->prepare(
                    "SELECT * FROM participants WHERE id=:pid"
                );
                $query2->execute(array(
                    ":pid" => $i["participant_id"]
                ));
            } catch (PDOException $e) {
                die("VIRHE: " . $e->getMessage());
            }
            $result2 = $query2->fetch();
            $participant = new Participant($result2[1], $result2[2], $result2[3]);
            $participant->setID($result2[0]);
            array_push($participants, $participant);
        }
        return $participants;
    }

    public function deleteEventParticipant($participant)
    {
        try {
            $query = $this->connection->prepare(
                "DELETE FROM events_participants WHERE participant_id=:pid"
            );
            $query->execute(array(
                ":pid" => $participant->getID()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }

    public function addEvent($event)
    {
        try {
            $query = $this->connection->prepare(
                "INSERT INTO events (title, description, address, start_time, end_time) VALUES (:title, :desc, :address, :st, :et)"
            );
            $query->execute(array(
                ":title" => $event->getTitle(),
                ":desc" => $event->getDescription(),
                ":address" => $event->getAddress(),
                ":st" => $event->getStartTime()->format("Y-m-d H:i:s"),
                ":et" => $event->getEndTime()->format("Y-m-d H:i:s")
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
        $this->addEventParticipants($event);
    }

    public function getEvents()
    {
        $events = [];
        try {
            $query = $this->connection->prepare(
                "SELECT * FROM events"
            );
            $query->execute();
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
        $result = $query->fetchAll();
        foreach ($result as $i) {
            $event = new Event($i[1], $i[2], $i[3], $i[4], $i[5], []);
            $event->setID($i[0]);
            $participants = $this->getEventParticipants($event);
            foreach ($participants as $participant) {
                $event->addParticipant($participant);
            }
            array_push($events, $event);
        }
        return $events;
    }

    public function updateEvent($event)
    {
        try {
            $query = $this->connection->prepare(
                "UPDATE events SET title = :title, description = :desc, address = :address, start_time = :st, end_time = :et WHERE id=:id"
            );
            $query->execute(array(
                ":title" => $event->getTitle(),
                ":desc" => $event->getDescription(),
                ":address" => $event->getAddress(),
                ":st" => $event->getStartTime()->format("Y-m-d H:i:s"),
                ":et" => $event->getEndTime()->format("Y-m-d H:i:s"),
                ":id" => $event->getID()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }

    public function deleteEvent($event)
    {
        try {
            $query = $this->connection->prepare(
                "DELETE FROM events_participants WHERE event_id=:eid"
            );
            $query->execute(array(
                ":eid" => $event->getID()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
        try {
            $query = $this->connection->prepare(
                "DELETE FROM events WHERE id=:id"
            );
            $query->execute(array(
                ":id" => $event->getID()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }

    public function addUser($user)
    {
        try {
            $query = $this->connection->prepare(
                "INSERT INTO kayttajat (nimi, email, salasana, admin) VALUES (:nm, :em, :ss, :ad)"
            );
            $query->execute(array(
                ":nm" => $user->getNimi(),
                ":em" => $user->getEmail(),
                ":ss" => $user->getSalasana(),
                ":ad" => $user->getAdmin()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }

    public function getUsers()
    {
        $users = [];
        try {
            $query = $this->connection->prepare(
                "SELECT * FROM kayttajat"
            );
            $query->execute();
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
        $result = $query->fetchAll();
        foreach ($result as $i) {
            $user = new User($i[1], $i[2], $i[3], $i[4]);
            $user->setID($i[0]);
            array_push($users, $user);
        }
        return $users;
    }

    public function updateUser($user)
    {
        try {
            $query = $this->connection->prepare(
                "UPDATE kayttajat SET nimi = :nm, email = :em, admin = :ad WHERE id=:id"
            );
            $query->execute(array(
                ":nm" => $user->getNimi(),
                ":em" => $user->getEmail(),
                ":ad" => $user->getAdmin(),
                ":id" => $user->getId()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }
    public function updatePassword($user)
    {
        try {
            $query = $this->connection->prepare(
                "UPDATE kayttajat SET salasana = :ss WHERE id=:id"
            );
            $query->execute(array(
                ":ss" => $user->getSalasana(),
                ":id" => $user->getId()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }

    public function deleteUser($user)
    {
        try {
            $query = $this->connection->prepare(
                "DELETE FROM kayttajat WHERE id=:id"
            );
            $query->execute(array(
                ":id" => $user->getID()
            ));
        } catch (PDOException $e) {
            die("VIRHE: " . $e->getMessage());
        }
    }
}
