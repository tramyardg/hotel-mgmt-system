<?php


class AdminHandler extends AdminDAO
{
    public function __construct()
    {
    }

    private $executionFeedback;

    public function getExecutionFeedback()
    {
        return $this->executionFeedback;
    }

    public function setExecutionFeedback($executionFeedback)
    {
        $this->executionFeedback = $executionFeedback;
    }

    public function createAdmin(Admin $admin)
    {
        if ($this->create($admin)) {
            $this->setExecutionFeedback(true);
        } else {
            $this->setExecutionFeedback(Util::DB_SERVER_ERROR);
        }
    }

    public function getAdmins()
    {
        if ($this->fetchAll()) {
            $this->setExecutionFeedback('Admin(s) found!');
            return $this->fetchAll();
        } else {
            return Util::DB_SERVER_ERROR;
        }
    }

    public function getAdminByEmail(Admin $admin)
    {
        if ($this->fetchByEmail($admin->getEmail())) {
            $this->setExecutionFeedback($admin->getEmail());
            return $this->getObjectUtil($admin->getEmail());
        } else {
            return $this->setExecutionFeedback(Util::DB_SERVER_ERROR);
        }
    }

    // convert result set to admin object
    public function getObjectUtil($email)
    {
        $p = $this->fetchByEmail($email);
        $a = new Admin();
        foreach ($p as $q) {
            $a->setAdminId($q->getAdminId());
            $a->setEmail($q->getEmail());
            $a->setFullName($q->getFullName());
            $a->setPassword($q->getPassword());
            $a->setPhone($q->getPhone());
        }
        return $a;
    }

}