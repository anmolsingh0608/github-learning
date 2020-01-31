<?php

class ControllerExtensionModuleNotification extends Controller
{
    public function index()
    {
        
        $data = [];
        if($this->config->get('notification_status')){
            $data['notification_title'] = $this->config->get('notification_title');
            $data['notification_message'] = $this->config->get('notification_message');
            $data['notification_starting_date'] = $this->config->get('notification_starting_date');
            $data['notification_ending_date'] = $this->config->get('notification_ending_date');            
        }

        return $this->load->view('extension/module/notification',$data);
    }
}
?>