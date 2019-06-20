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


}