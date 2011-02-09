<?php

class Controller_API_Task extends Controller_API
{
    public function action_index($id = NULL)
    {
        if ($id)
		{
            $task = ORM::factory('task', $id);

            if ( ! $task->loaded())
			{
			    throw new Http_Exception_404('The resource that you requested
			        does not exist. Verify that any bucket name or object key
			        provided is valid.');
            }

            $this->_raw_response = $task;
        }
		else
		{
            $this->_raw_response = ORM::factory('task')->find_all();
        }
    }

    public function action_create()
    {
        // Decode the posted JSON object as an array
        $values = json_decode($this->request->body(), TRUE);
        
        $task = ORM::factory('task')->values($values);
            
        try
        {
            $task->save();
        }
        catch (ORM_Validation_Exception $e)
        {
            throw new Http_Exception_400('The server could not understand your
                request. Verify that request parameters (and content, if any)
                are valid.');
        }

        $this->response->status(201);
        $this->_raw_response = array('ok' => TRUE, 'id' => $task->id);
    }

    public function action_update($id)
    {
        $task = ORM::factory('task', $id)
            ->values($this->input())
            ->save();

        $this->_raw_response = array('ok' => TRUE, 'id' => $task->id);
    }

    public function action_delete($id)
    {
        $task = ORM::factory('task', $id);

        if ( ! $task->loaded())
		{
		    throw new Http_Exception_404('The resource that you requested
		        does not exist. Verify that any bucket name or object key
		        provided is valid.');
        }

        $task->delete($id);

        $this->_raw_response = array('ok' => TRUE);
    }
}
