<?php
class ControllerExtensionModuleNotification extends Controller{
    private $error = [];
    
    public function index(){
        $this->load->language('extension/module/notification');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()){
            $this->model_setting_setting->editSetting('notification',$this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');
            
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
        }
 
        $data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_message'] = $this->language->get('entry_message');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_startingDate'] = $this->language->get('entry_startingDate');
        $data['entry_endingDate'] = $this->language->get('entry_endingDate');

		$data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        
        
        $data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

        if(isset($this->error['error_warning'])){
            $data['error_warning'] = $this->error['error_warning'];
        }
        else{
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/notification', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/module/notification', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
        
        $data['notification_status'] = $this->config->get('notification_status');
        $data['notification_title'] = $this->config->get('notification_title');
        $data['notification_message'] = $this->config->get('notification_message');
        $data['notification_starting_date'] = $this->config->get('notification_starting_date');
        $data['notification_ending_date'] = $this->config->get('notification_ending_date');

        $this->response->setOutput($this->load->view('extension/module/notification',$data));

    }

    protected function validate(){
        if($this->user->hasPermission('modify', 'extension/module/notification')){
			if(!empty($this->request->post['notification_title']) && !empty($this->request->post['notification_message']) && !empty($this->request->post['notification_starting_date']) && !empty($this->request->post['notification_ending_date'])){
                $start = $this->request->post['notification_starting_date'];
                $starting=strtotime("$start");
                $end = $this->request->post['notification_ending_date'];
                $ending=strtotime("$end");             
                if($starting<=$ending){
                  return true;
                }else{
                  echo '<script language="javascript">';
                  echo 'alert("starting date must be less then the ending date")';
                  echo '</script>';
                  return false;
                }
			}
			else{
                echo '<script language="javascript">';
                echo 'alert("all fields are required")';
                echo '</script>';
				return false;
			}
		}
		else{
			$this->error['warning'] = $this->language->get('error_permission');
			return $this->error;
		}
    }
}
?>