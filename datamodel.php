<?php
class Participant
{
    private string $firstName;
    private string $lastName;
    private string $email;

    public static function getFirstName()
    {
        return self::$firstName;
    }

    public static function setFirstName($new)
    {
        self::$firstName = $new;
    }


    public static function getLastName()
    {
        return self::$lastName;
    }

    public static function setLasttName($new)
    {
        self::$lastName = $new;
    }


    public static function getEmail()
    {
        return self::$email;
    }

    public static function setEmail($new)
    {
        self::$email = $new;
    }


    public function __construct(string $firstName, string $lastName, string $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}


class Event
{
    private string $title;
    private string $description;
    private string $address;
    private DateTime $startTime;
    private DateTime $endTime;
    private array $participants;

    public function addParticipant($Participant)
    {
        array_push(self::$participants, $Participant);
    }

    public function removeParticipant($Participant)
    {
        $index = array_search($Participant, self::$participants);
        array_splice(self::$participants, $index, 1);
    }



    public function getTitle()
    {
        return $this->title;
    }

    public static function setTitle($new)
    {
        self::$title = $new;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public static function setDescription($new)
    {
        self::$description = $new;
    }


    public function getAddress()
    {
        return $this->address;
    }

    public static function setAddress($new)
    {
        self::$address = $new;
    }


    public function getStartTime()
    {
        return $this->startTime;
    }

    public static function setStartTime($new)
    {
        self::$startTime = $new;
    }


    public function getEndTime()
    {
        return $this->endTime;
    }

    public static function setEndTime($new)
    {
        self::$endTime = $new;
    }



    public function __construct(string $title, string $description, string $address, int $startTimestamp, int $endTimestamp, array $participants)
    {
        
        $object1 = new DateTime();
        $object2 = new DateTime();
        $this->title = $title;
        $this->description = $description;
        $this->address = $address;
        $this->startTime = date_timestamp_set($object1, $startTimestamp);
        $this->endTime = date_timestamp_set($object2, $endTimestamp);
        $this->participants = $participants;
    }
}
?>