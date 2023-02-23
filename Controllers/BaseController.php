
<?php
class BaseController
{
    const VIEW_FOLDER_NAME = 'Views';
    const MODEL_FOLDER_NAME = 'Models';
    protected function view($viewPath, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        
        require_once(self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $viewPath) . '.php');
    }

    protected function loadModel($modelPath)
    {
        require_once (self::MODEL_FOLDER_NAME . '/' . $modelPath . '.php');
    }

    protected function validateInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    protected function debug($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
