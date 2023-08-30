<?php
class Participant
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;


    public function getID() {
        return $this->id;
    }

    public function setID($new){
        if ($this->id == 0) {
            $this->id = $new;
        }
    }


    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($new)
    {
        $this->firstName = $new;
    }


    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLasttName($new)
    {
        $this->lastName = $new;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($new)
    {
        $this->email = $new;
    }


    public function __construct(string $firstName, string $lastName, string $email)
    {
        $this->id = 0;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}


class Event
{
    private int $id;
    private string $title;
    private string $description;
    private string $address;
    private DateTime $startTime;
    private DateTime $endTime;
    private array $participants;

    public function addParticipant($Participant)
    {
        array_push($this->participants, $Participant);
    }

    public function removeParticipant($Participant)
    {
        $index = array_search($Participant, $this->participants);
        array_splice($this->participants, $index, 1);
    }



    public function getID() {
        return $this->id;
    }

    public function setID($new){
        if ($this->id == 0) {
            $this->id = $new;
        }
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($new)
    {
        $this->title = $new;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($new)
    {
        $this->description = $new;
    }


    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($new)
    {
        $this->address = $new;
    }


    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setStartTime($new)
    {
        $timeZone = new DateTimeZone("Europe/Helsinki");
        $this->startTime = new DateTime($new, $timeZone);
    }


    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setEndTime($new)
    {
        $timeZone = new DateTimeZone("Europe/Helsinki");
        $this->endTime = new DateTime($new, $timeZone);
    }



    public function __construct(string $title, string $description, string $address, string $startTimestamp, string $endTimestamp, array $participants)
    {
        $timeZone = new DateTimeZone("Europe/Helsinki");
        $this->id = 0;
        $this->title = $title;
        $this->description = $description;
        $this->address = $address;
        $this->startTime = new DateTime($startTimestamp, $timeZone);
        $this->endTime = new DateTime($endTimestamp, $timeZone);
        $this->participants = $participants;
    }
}
?>