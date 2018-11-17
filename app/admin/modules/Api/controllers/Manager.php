<?php
class ManagerController extends AbstractController
{
    public function init()
    {
        parent::init();
        $this->model = new \ManagerModel();
    }

    public function GETAction()
    {
        $data = $this->model->read();
        foreach ($data as &$v) {
            $v['lang_id'] = $this->model::get('hp_lang', $v['lang_id'])['name'];
            $v['status'] = l('status.'.$v['status']);
        }
        return $this->send($data);
    }

    public function POSTAction()
    {
        return $this->send($this->model->add());
    }

    public function PUTAction()
    {
        $id = (int) $this->getRequest()->getPut('id');
        return $this->send($this->model->update($id));
    }

    public function DELETEAction()
    {
        $id = (int) $this->getRequest()->getDelete('id');
        return $this->send($this->model->delete($id));
    }
}