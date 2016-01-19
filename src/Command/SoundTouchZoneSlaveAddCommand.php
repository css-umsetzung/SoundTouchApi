<?php

namespace TomCan\SoundTouch\Command;

use TomCan\SoundTouch\Response\SoundTouchZoneSlaveAddResponse;

class SoundTouchZoneSlaveAddCommand extends SoundTouchCommand
{

    private $master;
    private $members;

    public function __construct() {

        parent::__construct('POST', 'addZoneSlave');

    }

    public function preparePayload() {
        $this->payload = '<zone master="'.$this->master->getMacAddress().'" senderIPAddress="'.$this->master->getIpAddress().'">';
        foreach ($this->members as $member) {
            $this->payload .= '<member ipaddress="'.$member->getIpAddress().'">'.$member->getMacAddress().'</member>';
        }
        $this->payload .= '</zone>';

        return $this;
    }

    public function createResponse($responseText) {
        return new SoundTouchZoneSlaveAddResponse($responseText);
    }

    /**
     * @return mixed
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * @param mixed $master
     */
    public function setMaster($master)
    {
        $this->master = $master;
    }

    /**
     * @return mixed
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param mixed $members
     */
    public function setMembers($members)
    {
        $this->members = $members;
    }

}