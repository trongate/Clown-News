<?php
class Stories extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100); 

    function fetch_funny_headline($input) {
        
        $original_headline = $input['params']['original_headline'];

        //send the original headline to OpenAI
        $output = $this->make_funny_headline($original_headline);

        if($output->status !== 200) {
            http_response_code($output->status);
            echo $output->text; //error msg
            die();
        }

        http_response_code(200);
        $input['params']['funny_headline'] = $output->text;
        $input['params']['picture'] = '';
        return $input;
    }

    function init_gen_image() {
        //get some posted data
        $params = file_get_contents('php://input'); //json str
        $posted_params = json_decode($params);

        $update_id = $posted_params->updateId ?? 0;
        $headline = $posted_params->headline ?? '';

        if ($headline == '') {
            http_response_code(400);
            echo 'No headline';
            die();
        }

        //figure out what the main target subject is
        $output = $this->fetch_target_subject($headline);

        if($output->status !== 200) {
            http_response_code($output->status);
            echo $output->text; //error msg
            die();
        }

        $target_subject = $output->text;

        //generate an image, using OpenAI
        $output_img = $this->generate_image($target_subject);

        if($output_img->status !== 200) {
            http_response_code($output_img->status);
            echo $output_img->text; //error msg
            die();
        }

        //update the 'picture' column on the db
        $data['picture'] = $output_img->text;
        $update_id = (int) $update_id;
        $this->model->update($update_id, $data, 'stories');

        $pic_path = $output_img->text;
        http_response_code(200);  
        echo $pic_path;
    }

    function make_funny_headline($headline) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $prompt = 'Create a news headline that blames all bad news on a gang of evil, creepy clowns.  Give an absurd and funny explanation as to why clowns are responsible for the bad news.  The headline should be based on this: '.$headline;

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
            \"model\": \"text-davinci-002\",
            \"prompt\": \"" . $prompt . "\",
            \"max_tokens\": 100,
            \"top_p\": 1,
            \"stop\": \"\"
        }");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: Bearer ".API_KEY;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        // Get the HTTP status code
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];

        if (curl_error($ch)) {
            // There was an error
            $response_text = curl_error($ch);
        } else {
            // The request was successful
            $response_obj = json_decode($result);
            $response_text = $response_obj->choices[0]->text ?? '';
        }

        curl_close ($ch);

        // Create the output object
        $output = new stdClass();
        $output->text = trim($response_text);
        $output->status = $httpCode;

        return $output;
    }

    function fetch_target_subject($headline) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $prompt = 'What is the direct object in the following English sentence: '.$headline;

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
            \"model\": \"text-davinci-002\",
            \"prompt\": \"" . $prompt . "\",
            \"max_tokens\": 100,
            \"top_p\": 1,
            \"stop\": \"\"
        }");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: Bearer ".API_KEY;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        // Get the HTTP status code
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];

        if (curl_error($ch)) {
            // There was an error
            $response_text = curl_error($ch);
        } else {
            // The request was successful
            $response_obj = json_decode($result);
            $response_text = $response_obj->choices[0]->text ?? '';
        }

        curl_close ($ch);

        // Create the response object
        $output = new stdClass();

        $subject = $response_text;
        $bits = explode('"', $subject);
        if (isset($bits[1])) {
            $target_subject = $bits[1];
        } else {
            $alt_bits = explode(' is ', $subject);
            $target_subject = (isset($alt_bits[1])) ? $alt_bits[1] : $subject;
            $target_subject = strstr($target_subject, '.', true);
        }

        $output->text = trim($target_subject);
        $output->status = $httpCode;

        return $output;
    }

    function generate_image($target_subject) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/images/generations");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
            \"model\": \"image-alpha-001\",
            \"prompt\": \"Clown laughing in front of $target_subject'\",
            \"num_images\":1,
            \"size\":\"512x512\",
            \"response_format\":\"url\"
        }");
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: Bearer ".API_KEY;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        // Get the HTTP status code
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];

        if (curl_error($ch)) {
            // There was an error
            $response_text = curl_error($ch);
        } else {
            // The request was successful
            $response_obj = json_decode($result);
            $pic_path = $response_obj->data[0]->url ?? '';

            //remove unwanted whitespace
            $pic_path = trim($pic_path);
       
            //does the pic path look look?
            $str_start = substr($pic_path, 0, 4);

            if($str_start !== 'http') {
                $httpCode = 500; //Server Error
                $response_text = 'We could not generate an image on this occasion.';
            } else {
                $response_text = $pic_path;
            }

        }

        curl_close ($ch);

        // Create the output object
        $output = new stdClass();
        $output->text = $response_text;
        $output->status = $httpCode;

        return $output;
    }

    function create() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $update_id = (int) segment(3);
        $submit = post('submit');

        if (($submit == '') && ($update_id>0)) {
            $data = $this->_get_data_from_db($update_id);
        } else {
            $data = $this->_get_data_from_post();
        }

        if ($update_id>0) {
            $data['headline'] = 'Update Story Record';
            $data['cancel_url'] = BASE_URL.'stories/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Story Record';
            $data['cancel_url'] = BASE_URL.'stories/manage';
        }

        $data['form_location'] = BASE_URL.'stories/submit/'.$update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function manage() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (segment(4) !== '') {
            $data['headline'] = 'Search Results';
            $searchphrase = trim($_GET['searchphrase']);
            $params['original_headline'] = '%'.$searchphrase.'%';
            $sql = 'select * from stories
            WHERE original_headline LIKE :original_headline
            ORDER BY id';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Stories';
            $all_rows = $this->model->get('id');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->_get_limit();
        $pagination_data['pagination_root'] = 'stories/manage';
        $pagination_data['record_name_plural'] = 'stories';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->_reduce_rows($all_rows);
        $data['selected_per_page'] = $this->_get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'stories';
        $data['view_file'] = 'manage';
        $this->template('admin', $data);
    }

    function show() {
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed();
        $update_id = (int) segment(3);

        if ($update_id == 0) {
            redirect('stories/manage');
        }

        $data = $this->_get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data == false) {
            redirect('stories/manage');
        } else {
            $data['update_id'] = $update_id;
            $data['headline'] = 'Story Information';
            $data['view_file'] = 'show';
            $this->template('admin', $data);
        }
    }
    
    function _reduce_rows($all_rows) {
        $rows = [];
        $start_index = $this->_get_offset();
        $limit = $this->_get_limit();
        $end_index = $start_index + $limit;

        $count = -1;
        foreach ($all_rows as $row) {
            $count++;
            if (($count>=$start_index) && ($count<$end_index)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

    function submit() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $submit = post('submit', true);

        if ($submit == 'Submit') {

            $this->validation_helper->set_rules('original_headline', 'Original Headline', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('funny_headline', 'Funny Headline', 'min_length[2]');
            $this->validation_helper->set_rules('picture', 'Picture', 'min_length[2]');

            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = (int) segment(3);
                $data = $this->_get_data_from_post();
                
                if ($update_id>0) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'stories');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'stories');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('stories/show/'.$update_id);

            } else {
                //form submission error
                $this->create();
            }

        }

    }

    function submit_delete() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $submit = post('submit');
        $params['update_id'] = (int) segment(3);

        if (($submit == 'Yes - Delete Now') && ($params['update_id']>0)) {
            //delete all of the comments associated with this record
            $sql = 'delete from trongate_comments where target_table = :module and update_id = :update_id';
            $params['module'] = 'stories';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'stories');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('stories/manage');
        }
    }

    function _get_limit() {
        if (isset($_SESSION['selected_per_page'])) {
            $limit = $this->per_page_options[$_SESSION['selected_per_page']];
        } else {
            $limit = $this->default_limit;
        }

        return $limit;
    }

    function _get_offset() {
        $page_num = (int) segment(3);

        if ($page_num>1) {
            $offset = ($page_num-1)*$this->_get_limit();
        } else {
            $offset = 0;
        }

        return $offset;
    }

    function _get_selected_per_page() {
        $selected_per_page = (isset($_SESSION['selected_per_page'])) ? $_SESSION['selected_per_page'] : 1;
        return $selected_per_page;
    }

    function set_per_page($selected_index) {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (!is_numeric($selected_index)) {
            $selected_index = $this->per_page_options[1];
        }

        $_SESSION['selected_per_page'] = $selected_index;
        redirect('stories/manage');
    }

    function _get_data_from_db($update_id) {
        $record_obj = $this->model->get_where($update_id, 'stories');

        if ($record_obj == false) {
            $this->template('error_404');
            die();
        } else {
            $data = (array) $record_obj;
            return $data;        
        }
    }

    function _get_data_from_post() {
        $data['original_headline'] = post('original_headline', true);
        $data['funny_headline'] = post('funny_headline', true);
        $data['picture'] = post('picture', true);        
        return $data;
    }

}