<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Website extends Controller_Template {

	public $template = 'website/template';

	public function before()
	{
		if ($this->request->action === 'media')
		{
			// Do not template media files
			$this->auto_render = FALSE;
		}

		parent::before();
	}
	
	public function action_index()
	{
		$this->template->content = View::factory('website/index');
	}

	public function action_media()
	{
		// Generate and check the ETag for this file
		$this->request->check_cache(sha1($this->request->uri));

		// Get the file path from the request
		$file = $this->request->param('file');

		// Find the file extension
		$ext = pathinfo($file, PATHINFO_EXTENSION);

		// Remove the extension from the filename
		$file = substr($file, 0, -(strlen($ext) + 1));

		if ($file = Kohana::find_file('media', $file, $ext))
		{
			// Send the file content as the response
			$this->request->response = file_get_contents($file);
		}
		else
		{
			// Return a 404 status
			$this->request->status = 404;
		}

		// Set the proper headers to allow caching
		$this->request->headers['Content-Type']   = File::mime_by_ext($ext);
		$this->request->headers['Content-Length'] = filesize($file);
		$this->request->headers['Last-Modified']  = date('r', filemtime($file));
	}
}
