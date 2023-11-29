<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Communications extends ClientsController
{
    public function __construct()
	{
        parent:: __construct();
        $this->load->library('session');
		$this->load->model('CommunicationsClientsModel');
    }
	
	
    public function index()
	{
		
		
    }
	
	
	public function dashboard()	
	{	

		$data['emails'] = $this->CommunicationsClientsModel->getAdminsEmail();		
			
		
		$tab = $this->input->get('tab');
				
        switch ($tab) 
		{
			case 'inbox':
                $messages = $this->CommunicationsClientsModel->getInboxCommunicationsWithoutStatus('sent');
                break;
            case 'sent':
                $messages = $this->CommunicationsClientsModel->getCommunicationsByStatus('sent');
                break;
            case 'draft':
                $messages = $this->CommunicationsClientsModel->getCommunicationsByStatus('draft');
                break;
            default:
                // If the 'status' parameter is not provided or doesn't match any known status, retrieve all messages that are not drafts or sent
                $messages = $this->CommunicationsClientsModel->getInboxCommunicationsWithoutStatus();
                break;
        }
		
        $data['messages'] = $messages;	
		$this->data($data);
		$this->view('communications', $data);
        $this->layout();
		
	}
	
	public function sendCommunications()
	{
				
		$from_email = $this->input->post('from_email');
		$from_email_parts = explode(" - ", $from_email);
		
		$to_email = $this->input->post('to_email');
		$to_email_parts = explode(" - ", $to_email);
		
		// Client data found; insert data into the communications table
		$data = array(			
			'from_email' => $from_email_parts[0],
			'sender_name' => $from_email_parts[1],
			'to_email' => $to_email_parts[0],
			'recipient_name' => $to_email_parts[1],			
			'subject' => $this->input->post('subject'),
			'message' => $this->input->post('message'),
			'is_reply' => FALSE,
		);

		// Debugging: Check the value of $data
		// echo "Data to be inserted: " . print_r($data, true);

		$inserted_id = $this->CommunicationsClientsModel->insertCommunications($data);
		
		// Set the last insert ID as the thread_id for the original message
		$this->db->where('id', $inserted_id);
		$this->db->update(db_prefix() . 'communications', array('thread_id' => $inserted_id));

		if ($inserted_id > 0) 
		{
			// Data inserted successfully
			$response['success'] = 'Message sent successfully.';
		} 
		else 
		{
			// Insertion failed
			$response['error'] = 'Failed to sent message.';
		}

		// Send the JSON response
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	
	public function viewMessage($id) 
	{   
		$data['emails'] = $this->CommunicationsClientsModel->getAdminsEmail();		
		
		// Fetch the communication record by ID
        $communication = $this->CommunicationsClientsModel->getCommunicationById($id);

        if (!$communication) 
		{
            // Handle the case where the communication with the given ID doesn't exist
            //show_404();
			//$this->view('communications');
			//$this->layout();
			redirect(site_url('communications/dashboard'));
        }

        		
		$data['communication'] = $communication;	
		$this->data($data);
		$this->view('communications_view', $data);
        $this->layout();

    }
	
	
	
	
	
	public function sendReplyCommunications()
	{
		$reply_from_email = $this->input->post('reply_from_email');
		$reply_from_email_parts = explode(" - ", $reply_from_email);
		
		$reply_to_email = $this->input->post('reply_to_email');
		$reply_to_email_parts = explode(" - ", $reply_to_email);

		// Client data found; insert data into the communications table
		$data = array(
			'thread_id' => $this->input->post('reply_thread_id'),
			'from_email' => $reply_from_email_parts[0],
			'sender_name' => $reply_from_email_parts[1],
			'to_email' => $reply_to_email_parts[0],
			'recipient_name' => $reply_to_email_parts[1],
			'subject' => $this->input->post('reply_subject'),
			'message' => $this->input->post('reply_message'),
			'is_reply' => TRUE,
			'in_reply_to' => $this->input->post('reply_message_id'),
		);
		

		$inserted_id = $this->CommunicationsClientsModel->insertReplyCommunications($data);

		if ($inserted_id > 0) 
		{			
			// Data inserted successfully
			$response['success'] = 'Success : Reply Message sent successfully!';
		} 
		else 
		{			
			// Insertion failed
			$response['error'] = 'Error : Failed to send reply message. Please try again.';
		}
				
		// Send the JSON response
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	
	
	
	
	
	
	
	
    
}
